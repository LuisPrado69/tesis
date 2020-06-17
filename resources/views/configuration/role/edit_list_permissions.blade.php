{{-- First level --}}
@foreach(permissions($entity) as $key1 =>  $permission1)
    <div class="panel">
        <a class="panel-heading" role="tab" id="heading-{{ $permission1['name'] }}"
           href="#collapse-{{ $permission1['name'] }}"
           data-toggle="collapse" data-parent="#adminRolesAccordion"
           aria-expanded="true"
           aria-controls="collapse-{{ $permission1['name'] }}">
            <h4 class="panel-title text-uppercase">
                {{ $permission1['label'] }}
            </h4>
        </a>

        <div role="tabpanel" class="panel-collapse collapse"
             id="collapse-{{ $permission1['name'] }}"
             aria-labelledby="heading-{{ $permission1['name'] }}">
            <div class="panel-body">
                <div>
                    <ul class="to_do" id="{{ $permission1['name'] }}">
                        <li>
                            <label>
                                <input type="checkbox"
                                       class="js-switch js-check-all-permissions">
                                {{ trans('roles.labels.check_all') }}
                            </label>
                        </li>
                        {{-- Second level --}}
                        @foreach(order_permissions($permission1['actions']) as $key2 => $permission2)
                            <li>
                                @if(isset($permission2['is_primary']) && $permission2['is_primary'])
                                    <div class="panel">
                                        <a class="panel-heading"
                                           role="tab"
                                           id="heading-{{ $key1 . $key2 }}"
                                           href="#collapse-{{ $key1 . $key2 }}"
                                           data-toggle="collapse"
                                           aria-expanded="true"
                                           aria-controls="collapse-{{ $key2 }}">
                                            <h4 class="panel-title text-uppercase">
                                                {{ $permission2['label'] }}
                                            </h4>
                                        </a>
                                        <div role="tabpanel"
                                             class="panel-collapse collapse"
                                             id="collapse-{{ $key1 . $key2 }}"
                                             aria-labelledby="heading-{{ $key1 . $key2 }}"
                                             aria-expanded="true">
                                            <div class="panel-body">
                                                <div>
                                                    <ul class="to_do" id="{{ $key2 }}"
                                                        base_second="{{ $permission1['name'] }}">
                                                        <li>
                                                            <label>
                                                                <input type="checkbox"
                                                                       class="js-switch js-check-all-permissions">
                                                                {{ trans('roles.labels.check_all') }}
                                                            </label>
                                                        </li>
                                                        {{-- Third Level --}}
                                                        @foreach(order_permissions($permission2['inner']) as $key3 => $permission3)
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox"
                                                                           class="js-switch js-check-permission"
                                                                           value="{{ $key3 }}"
                                                                           @if($permission3['allowed'] == 'true') checked @endif/>
                                                                    {{ $permission3['label'] }}
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <label>
                                        <input type="checkbox" class="js-switch js-check-permission"
                                               value="{{ $key2 }}"
                                               @if($permission2['allowed'] == 'true') checked @endif/>
                                        {{ $permission2['label'] }}
                                    </label>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach