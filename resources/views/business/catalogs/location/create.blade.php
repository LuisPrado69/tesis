@permission('create.location.catalogs')
<div class="modal-content" id="location_create">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-plus"></i> {{ trans('location.labels.create') }}
        </h4>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" action="{{ route('store.create.location.catalogs') }}"
                  method="post" class="form-horizontal form-label-left" id="location_fm">
                @csrf
                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
                        {{ trans('location.labels.name') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="name" id="name" class="form-control" placeholder="{{ trans('location.placeholders.name') }}"/>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="latitude">
                        {{ trans('location.labels.latitude') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="number" name="latitude" id="latitude" class="form-control"
                               placeholder="{{ trans('location.placeholders.latitude') }}"/>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longitude">
                        {{ trans('location.labels.longitude') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="number" name="longitude" id="longitude" class="form-control"
                               placeholder="{{ trans('location.placeholders.longitude') }}"/>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <a class="btn btn-info closeModal">
                        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
    </div>
</div>

<script>
    $(() => {
        let $form = $('#location_fm');

        $validateDefaults.rules = {
            name: {
                required: true,
                maxlength: 100,
                remote: {
                    url: "{!! route('verify.create.location.catalogs') !!}",
                    data: {
                        name: function () {
                            return $("#name", $form).val();
                        }
                    }
                }
            },
            latitude: {
                required: true,
                maxlength: 100
            },
            longitude: {
                required: true,
                maxlength: 100
            }
        };

        $validateDefaults.messages = {
            name: {
                remote: '{!! trans('location.messages.validation.name') !!}'
            }
        };

        $form.validate($validateDefaults);

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $modal.modal('hide');
                });
            }
        }));

        $('.closeModal').on('click', (e) => {
            $modal.modal('hide');
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission