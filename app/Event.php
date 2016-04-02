<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    //protected $table = 'events';
    //Mass Assignment
    protected $fillable = ['title', 'url_slug', 'start_date', 'end_date', 'image', 'brief', 'description', 'published_at']; //Whitelist
    //protected $guarded = ['id'];// //Backlist

    protected $dates = ['start_date', 'end_date', 'published_at']; //register datetime to carbon object

    //Scope
    public function scopePublished($query)
    {
      $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
      $query->where('published_at', '>', Carbon::now());
    }

    public function getGalleryListAttribute()
    {
        return $this->gallery->lists('image');
    }

    public function getBranchListAttribute()
    {
      return $this->branch->lists('name');
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
       return $query->where('active', 'Y');
    }

    public function scopeEventBrand($query)
    {
      return $query->leftJoin('brand','brand.id','=','events.brand_id')->select('events.*', 'brand.id as brand_id', 'brand.name as brand_name');
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
