@extends('layouts.admin')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('admin/menu.title')!!}</h2>
    <ol class="breadcrumb">
      <li>
          <a href="{{url('admin/dash')}}">{!!trans('admin/breadcrumb.home')!!}</a>
      </li>
      <li>
          <a href="{{url('admin/viewer')}}">{!!trans('admin/breadcrumb.log.dash')!!}</a>
      </li>
      <li class="active">
          <strong>{!!trans('admin/breadcrumb.log.list')!!}</strong>
      </li>
    </ol>
  </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>{!!trans('admin/breadcrumb.log.list')!!}</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
      {!! $rows->render() !!}
      <div class="table-responsive">
          <table class="table table-condensed table-hover table-stats">
              <thead>
                  <tr>
                      @foreach($headers as $key => $header)
                      <th class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                          @if ($key == 'date')
                              <span class="label label-info">{{ $header }}</span>
                          @else
                              <span class="level level-{{ $key }}">
                                  {!! log_styler()->icon($key) . ' ' . $header !!}
                              </span>
                          @endif
                      </th>
                      @endforeach
                      <th class="text-right">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($rows as $date => $row)
                  <tr>
                      @foreach($row as $key => $value)
                      <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                          @if ($key == 'date')
                              <span class="label label-primary">{{ $value }}</span>
                          @elseif ($value == 0)
                              <span class="level level-empty">{{ $value }}</span>
                          @else
                              <a href="{{ route('log.filter', [$date, $key]) }}">
                                  <span class="level level-{{ $key }}">{{ $value }}</span>
                              </a>
                          @endif
                      </td>
                      @endforeach
                      <td class="text-right">
                        @permission(config('admin.permissions.log.show'))
                        <a href="{{ route('log.show', [$date]) }}" class="btn btn-xs btn-info">
                            <i class="fa fa-search"></i>
                        </a>
                        @endpermission
                        @permission(config('admin.permissions.log.download'))
                        <a href="{{ route('log.download', [$date]) }}" class="btn btn-xs btn-success">
                            <i class="fa fa-download"></i>
                        </a>
                        @endpermission
                        @permission(config('admin.permissions.log.destroy'))
                        <a href="#delete-log-modal" class="btn btn-xs btn-danger" data-log-date="{{ $date }}">
                            <i class="fa fa-trash-o"></i>
                        </a>
                        @endpermission
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      {!! $rows->render() !!}
      <div id="delete-log-modal" class="modal fade">
          <div class="modal-dialog">
              <form id="delete-log-form" action="{{ route('log.destroy') }}" method="POST">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="date" value="">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title">DELETE LOG FILE</h4>
                      </div>
                      <div class="modal-body">
                          <p></p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">DELETE FILE</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('js')
<script>
  $(function () {
    var deleteLogModal = $('div#delete-log-modal'),
        deleteLogForm  = $('form#delete-log-form'),
        submitBtn      = deleteLogForm.find('button[type=submit]');

    $("a[href=#delete-log-modal]").click(function(event) {
        event.preventDefault();
        var date = $(this).data('log-date');
        deleteLogForm.find('input[name=date]').val(date);
        deleteLogModal.find('.modal-body p').html(
            'Are you sure you want to <span class="label label-danger">DELETE</span> this log file <span class="label label-primary">' + date + '</span> ?'
        );

        deleteLogModal.modal('show');
    });

    deleteLogForm.submit(function(event) {
        event.preventDefault();
        submitBtn.button('loading');

        $.ajax({
            url:      $(this).attr('action'),
            type:     $(this).attr('method'),
            dataType: 'json',
            data:     $(this).serialize(),
            success: function(data) {
                submitBtn.button('reset');
                if (data.result === 'success') {
                    deleteLogModal.modal('hide');
                    location.reload();
                }
                else {
                    alert('AJAX ERROR ! Check the console !');
                    console.error(data);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                alert('AJAX ERROR ! Check the console !');
                console.error(errorThrown);
                submitBtn.button('reset');
            }
        });

        return false;
    });

    deleteLogModal.on('hidden.bs.modal', function(event) {
        deleteLogForm.find('input[name=date]').val('');
        deleteLogModal.find('.modal-body p').html('');
    });
  });
</script>
@stop
