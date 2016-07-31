@extends('layouts.admin')
@section('page_title', 'Administrator')
@section('content')

<div class="social-wrapper">
  <div class="social-test" data-pages="social">
    <div class="container-fluid container-fixed-lg bg-white sm-p-l-10 sm-p-r-10 m-t-20">

      <!-- START PANEL -->
      <div class="panel panel-list panel-transparent">
        <div class="panel-heading">
          <div class="panel-title">Table Event Lists
          </div>
          <div class="export-options-container-no pull-right">
              <a href="/events/create" id="show-modal" class="btn btn-primary btn-xs btn-cons pull-right"><i class="fa fa-plus"></i> Add Event</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-list-admin display responsive nowrap" id="table_event_list_admin" width="100%">
            <thead>
              <tr>
                <th class="all" width="120">Action</th>
                <th class="all">Title</th>
                <th class="min-phone-l">Brand</th>
                <th class="desktop">Start Date</th>
                <th class="desktop">End Date</th>
                <!--
                <th width="120">Action</th>
                <th>Title</th>
                <th data-hide="phone">Brand</th>
                <th data-hide="phone,tablet">Start Date</th>
                <th data-hide="phone,tablet">End Date</th>
                -->
              </tr>
            </thead>
            <tbody>

              {{--
              @forelse($events as $event)
              <tr class="odd gradeX">
                <td><a href="/events/{{ $event->id }}/edit" id="show-modal" class="btn btn-xs btn-danger btn-sm"><i class="fa fa-magic"></i> Edit</a></td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->brand->name }}</td>
                <td class="center">{{ $event->start_date_thai }}</td>
                <td class="center">{{ $event->end_date_thai }}</td>
              </tr>
              @empty
              @endforelse
              --}}

            </tbody>
          </table>
        </div>
      </div>
      <!-- END PANEL -->

    </div>
    <!-- END CONTAINER FLUID -->
  </div>
  <!-- /container -->
</div>
@stop
