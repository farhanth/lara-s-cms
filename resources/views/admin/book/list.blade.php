@extends('_template_adm.master')

@php
  // USE LIBRARIES
  use App\Libraries\Helper;

  $this_object = ucwords(lang('book', $translation));

  if(isset($data)){
    $pagetitle = $this_object;
    $link_get_data = route('admin.book.get_data');
    $function_get_data = 'refresh_data();';
  }else{
    $pagetitle = ucwords(lang('deleted #item', $translation, ['#item' => $this_object]));
    $link_get_data = route('admin.book.get_data_deleted');
    $function_get_data = 'refresh_data_deleted();';
  }
@endphp

@section('title', $pagetitle)

@section('content')
  <div class="">
    <!-- message info -->
    @include('_template_adm.message')

    <div class="page-title">
      <div class="title_left">
        <h3>{{ $pagetitle }}</h3>
      </div>

      @if (isset($data))
        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
            @if (Helper::authorizing('Banner', 'Restore')['status'] == 'true')
              <a href="{{ route('admin.book.deleted') }}" class="btn btn-round btn-danger" style="float: right; margin-bottom: 5px;" data-toggle="tooltip" title="{{ ucwords(lang('view deleted items', $translation)) }}">
                <i class="fa fa-trash"></i>
              </a>
            @endif
            <a href="{{ route('admin.book.create') }}" class="btn btn-round btn-success" style="float: right;">
              <i class="fa fa-plus-circle"></i>&nbsp; {{ ucwords(lang('add new', $translation)) }}
            </a>
          </div>
        </div>
      @else
        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
            <a href="{{ route('admin.book.list') }}" class="btn btn-round btn-primary" style="float: right;">
              <i class="fa fa-check-circle"></i>&nbsp; {{ ucwords(lang('active items', $translation)) }}
            </a>
          </div>
        </div>
      @endif
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>{{ ucwords(lang('data list', $translation)) }}</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="table-responsive">
              <table id="datatables" class="table table-striped table-bordered" style="display:none">
                <thead>
                  <tr>
                    <th>{{ ucwords(lang('image', $translation)) }}</th>
                    <th>{{ ucwords(lang('title', $translation)) }}</th>
                    <th>{{ ucwords(lang('summary', $translation)) }}</th>
                    <th>{{ ucwords(lang('price', $translation)) }}</th>
                    <th>{{ ucwords(lang('created', $translation)) }}</th>
                    <th>{{ ucwords(lang('last updated', $translation)) }}</th>
                    <th>{{ ucwords(lang('action', $translation)) }}</th>
                  </tr>
                </thead>
                <tbody class="sorted_table" id="sortable-data"></tbody>
              </table>

              <table id="datatables-deleted" class="table table-striped table-bordered" style="display:none">
                <thead>
                  <tr>
                    <th>{{ ucwords(lang('image', $translation)) }}</th>
                    <th>{{ ucwords(lang('title', $translation)) }}</th>
                    <th>{{ ucwords(lang('summary', $translation)) }}</th>
                    <th>{{ ucwords(lang('price', $translation)) }}</th>
                    <th>{{ ucwords(lang('created', $translation)) }}</th>
                    <th>{{ ucwords(lang('deleted at', $translation)) }}</th>
                    <th>{{ ucwords(lang('action', $translation)) }}</th>
                  </tr>
                </thead>
                <tbody id="sortable-data-deleted"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('css')
  <!-- Sortable-Table -->
  @include('_form_element.sortable_table.css')

  <!-- Select2 -->
  @include('_form_element.select2.css')
@endsection

@section('script')
  <script>
    var AjaxSortingURL = '{{ route("admin.book.sorting") }}';

    $(document).ready(function() {
      {{ $function_get_data }}
    });

    function refresh_data() {
      $('#datatables').show();

      $.ajax({
        type: 'GET',
        url: '{{ $link_get_data }}',
        success: function(response){
          // console.log(response);
          if (typeof response.status != 'undefined') {
            if (response.status == 'true') {
              var html = '';
              if (response.data == '') {
                html += '<tr><td colspan="6"><h2 class="text-center">{{ strtoupper(lang("no data available", $translation)) }}</h2></td></tr>';
              } else {
                $.each(response.data, function (index, value) {
                  html += '<tr role="row" id="row-'+value.id+'" title="{{ ucfirst(lang("Drag & drop to sorting", $translation)) }}" data-toggle="tooltip">';
                    html += '<td class="dragndrop"><img src="'+value.image_item+'" style="max-width:200px;"></td>';
                    html += '<td>'+value.title+'</td>';
                    html += '<td>'+value.summary+'</td>';
                    html += '<td>'+value.price+'</td>';

                    html += '<td>'+value.created_at_edited+'</td>';
                    html += '<td>'+value.updated_at_edited+'</td>';

                    action_edit = '<a href="{{ url("/".env("ADMIN_DIR")."/book/edit") }}/'+value.id+'" class="btn btn-xs btn-primary" title="{{ ucwords(lang("edit", $translation)) }}"><i class="fa fa-pencil"></i>&nbsp; {{ ucwords(lang("edit", $translation)) }}</a>';
                    action_delete = '<form action="{{ route("admin.book.delete") }}" method="POST" onsubmit="return confirm(\'{{ lang("Are you sure to delete this #item?", $translation, ["#item"=>$this_object]) }}\');" style="display: inline">{{ csrf_field() }}<input type="hidden" name="id" value="'+value.id+'"><button type="submit" class="btn btn-xs btn-danger" title="{{ ucwords(lang("delete", $translation)) }}"><i class="fa fa-trash"></i>&nbsp; {{ ucwords(lang("delete", $translation)) }}</button></form>';
                    html += '<td>'+action_edit+action_delete+'</td>';
                  html += '</tr>';
                });
              }
              $('#sortable-data').html(html);
            } else {
              alert(response.message);
            }
          } else {
            alert ('Server not respond, please refresh your page');
          }
        },
        error: function (data, textStatus, errorThrown) {
          console.log(data);
          console.log(textStatus);
          console.log(errorThrown);
        }
      });
    }

    function refresh_data_deleted() {
      $('#datatables-deleted').show();

      $.ajax({
        type: 'GET',
        url: '{{ $link_get_data }}',
        success: function(response){
          // console.log(response);
          if (typeof response.status != 'undefined') {
            if (response.status == 'true') {
              var html = '';
              if (response.data == '') {
                html += '<tr><td colspan="6"><h2 class="text-center">{{ strtoupper(lang("no data available", $translation)) }}</h2></td></tr>';
              } else {
                $.each(response.data, function (index, value) {
                  html += '<tr>';
                    html += '<td class="dragndrop"><img src="'+value.image_item+'" style="max-width:200px;"></td>';
                    html += '<td>'+value.title+'</td>';
                    html += '<td>'+value.summary+'</td>';
                    html += '<td>'+value.price+'</td>';

                    html += '<td>'+value.created_at_edited+'</td>';
                    html += '<td>'+value.updated_at_edited+'</td>';

                    action_restore = '<form action="{{ route("admin.book.restore") }}" method="POST" onsubmit="return confirm(\'{{ lang("Are you sure to restore this #item?", $translation, ["#item"=>$this_object]) }}\');" style="display: inline">{{ csrf_field() }}<input type="hidden" name="id" value="'+value.id+'"><button type="submit" class="btn btn-xs btn-primary" title="{{ ucwords(lang("restore", $translation)) }}"><i class="fa fa-check"></i>&nbsp; {{ ucwords(lang("restore", $translation)) }}</button></form>';
                    html += '<td>'+action_restore+'</td>';
                  html += '</tr>';
                });
              }
              $('#sortable-data-deleted').html(html);
            } else {
              alert(response.message);
            }
          } else {
            alert ('Server not respond, please refresh your page');
          }
        },
        error: function (data, textStatus, errorThrown) {
          console.log(data);
          console.log(textStatus);
          console.log(errorThrown);
        }
      });
    }
  </script>

  <!-- Sortable-Table -->
  @include('_form_element.sortable_table.script')
  <!-- Select2 -->
  @include('_form_element.select2.script')
@endsection