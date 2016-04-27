<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Iverberk\Larasearch\Traits\SearchableTrait;

class Event extends Model
{
    use SearchableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    //protected $table = 'events';
    //Mass Assignment
    protected $fillable = ['title', 'url_slug', 'start_date', 'end_date', 'image', 'brief', 'description', 'published_at', 'user_id', 'brand_id']; //Whitelist
    //protected $guarded = ['id'];// //Backlist

    protected $dates = ['start_date', 'end_date', 'published_at']; //register datetime to carbon object

    //Larasearch
    /*public static $__es_config = [
       'suggest' => ['title', 'url_slug', 'brief', 'brand.name', 'branch.name']
    ];*/

    public static $__es_config = [
        'autocomplete' => ['title'],
        'suggest' => ['title'],
        'word_start' => ['title']
    ];

    /**
    * @return bool
    */
    public function shouldIndex()
    {
        // Your custom logic to determine if a (re)index should be performed
    }

    //Scope
    public function scopePublished($query)
    {
      $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
      $query->where('published_at', '>', Carbon::now());
    }

    public function scopeNoExpire($query)
    {
      $query->where('end_date', '>=', Carbon::today());
    }

    //category, edit list
    public function getCategoryListAttribute()
    {
        //return $this->tags->lists('id');
        return $this->category->lists('id')->all(); //relationship category events
        //or ican do this
        //return $this->category->lists('id')->toArray();
    }

    //tags, edit list
    public function getTagListAttribute()
    {
        return $this->tags->lists('name')->all(); //relationship tags events
    }

    public function getGalleryListAttribute()
    {
        return $this->gallery->lists('image')->all();
    }

    public function getLocationFirstAttribute()
    {
        return $this->location->first();
    }

    public function getBranchListAttribute()
    {
      return $this->branch->lists('name', 'id')->all();
    }

    public function getCategoryFirstAttribute()
    {
        return $this->category->first();
    }

    protected function convertDate($timestamp)
    {
      // Quick month array
      $m = array("01"=>"ม.ค.",
             "02"=>"ก.พ.",
             "03"=>"มี.ค.",
             "04"=>"เม.ย.",
             "05"=>"พ.ค.",
             "06"=>"มิ.ย.",
             "07"=>"ก.ค.",
             "08"=>"ส.ค.",
             "09"=>"ก.ย.",
             "10"=>"ต.ค.",
             "11"=>"พ.ย.",
             "12"=>"ธ.ค."
      );

      if(!starts_with($timestamp, '0000')) {
        $date = date('Y-m-d', strtotime($timestamp));
        return ((int) substr($date, 8)).' '.$m[substr($date, 5, -3)].' '.(substr($date, 2, -6)+43);
      } else {
        return 'ไม่ระบุ';
      }
    }

    public function getCheckExpireAttribute()
    {
      $startdate = new Carbon($this->start_date);
      $enddate = new Carbon($this->end_date->addHour(23)->addMinute(59)->addSeconds(59));
      $current = Carbon::now();
      $diff_start = $current->diffInDays($startdate, false);
      $diff_end = $current->diffInDays($enddate, false);
      $difference = '';
      switch(true){
        case ($startdate > $current):
          $difference = 'อีก ' . ($diff_start + 1) . ' วันเริ่มโปรโมชั่น';
        break;
        case($diff_end >= 1):
          $difference = 'เหลือเวลาอีก : ' . $diff_end . ' วัน';
        break;
        case ($diff_end < 1):
          $difference = 'หมดโปรโมชั่นแล้ว!!';
        break;
        default:
          $difference = 'ไม่ระบุ';
        break;
      }
      //$difference = ($diff < 1) ? 'หมดโปรโมชั่นแล้ว!!' : 'เหลือเวลาอีก : ' . $diff . ' วัน';
      return $difference;
    }

    public function getEndDateThaiAttribute()
    {
      //return $this->convertDate($this->getAttribute('end_date'));
      return $this->convertDate($this->end_date);
    }

    public function getStartDateThaiAttribute()
    {
      //return $this->convertDate($this->getAttribute('start_date'));
      return $this->convertDate($this->start_date);
    }

    public function scopeSetLocal($query)
    {
      Carbon::setLocale('th');
    }

    /**
    * Scope a query to only include active events.
    *
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeActive($query)
    {
       return $this->where('active', 'Y');
    }

    public function scopeRelateThis($query, $event_id, $cate_id)
    {
      //return $this->where('id', '!=', $event_id);
      //return $this->with(['category','tags'])->where('id', '!=', $event_id);
      //return $this->where('id', '!=', $event_id);

      return $this->whereHas('category', function($query) use ($cate_id) {
        $query->where('categories.id', $cate_id);
      })->with(['category' => function($query) use ($cate_id){
        //$query->where('category.id', $cate_id);
      }])->where('id', '!=', $event_id); //->get();

      //return $this->leftJoin('event_category', 'events.id', '=', 'event_category.cate_id')->where('events.id', '!=', $event_id)->where('event_category.cate_id', '=', $cate_id); //->orWhere('event_category.cate_id', '=', $cate_id);
    }

    public function scopeEventBrand($query)
    {
      return $this->leftJoin('brand','events.brand_id','=','brand.id')->select('events.*', 'brand.id as brand_id', 'brand.name as brand_name');
    }

    public function scopeBrandId($query, $brand)
    {
      return $this->where('brand_id', $brand);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function tags()
    {
      return $this->belongsToMany('App\Tag')
                  ->withTimestamps(); //update created app, updated app relationship table
    }

    public function category()
    {
      return $this->belongsToMany('App\Category', 'event_category', 'event_id', 'cate_id')
                  ->withTimestamps(); //update created app, updated app relationship table
    }

    public function gallery()
    {
      return $this->belongsToMany('App\Gallery')
                  ->withTimestamps(); //update created app, updated app relationship table
    }

    public function location()
    {
      return $this->belongsToMany('App\Location')
                  ->withTimestamps(); //update created app, updated app relationship table
    }

    public function branch()
    {
      return $this->belongsToMany('App\Branch', 'event_branch')
                  ->withTimestamps(); //update created app, updated app relationship table
    }
}
