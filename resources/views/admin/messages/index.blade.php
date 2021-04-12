@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">All Messages
                </li>
            </ol>
        </div>
    </div>
</div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 ">Sent Messages</div>
                        <div class="col-md-6 ">
                            <form class="" action="">
                                <div class="row">
                                    <input class="col-md-10" type="text" name="q" placeholder="Enter search word" class="form-control pull-right">
                                    <button class="btn btn-sm btn-primary col-md-2">Search</button>
                                </div>
                            </form>
                        </div>
                        @if (auth()->user()->hasPermission('edit_message'))
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Send a New Message
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Recepient(s)</th>
                                        <th scope="col">Channel</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($messages) @foreach ($messages as $key => $message)
                                    <tr>
                                        <th scope="row">{{$key + $messages->firstItem()}}</th>
                                        <td>{{$message->created_at}}</td>
                                        <td>{{$message->content}}</td>
                                        <td>{{$message->recepient}}</td>
                                        <td>{{$message->channel}}</td>
                                        <td><a href="{{url('/admin/messages/'.$message->id)}}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                    @endforeach @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @isset($messages)
                {{ $messages->links() }}
            @endisset
        </div>
    </div>
</div>

@if (auth()->user()->hasPermission('edit_message'))
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Send New Message</h5>
            </div>
            <div class="modal-body">
                <div id="messaging">
                    <form method="POST" action="{{url('/admin/messages')}}">
                        @csrf
                        <div class="col">
                        <div class="text-center" style="color:seagreen">
                            <span>SMS Remaining - {{settings('SMS_REMAINING')}} </span>&nbsp; | &nbsp;
                            <span>Total Users: {{\App\User::count()}} </span>&nbsp; | &nbsp;
                            <span>Total Residents: {{\App\Resident::count()}} </span>&nbsp;| &nbsp;
                            <span>Total Landlords: {{\App\Landlord::count()}} </span>
                        </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="channel">Channel</label>
                                <select v-model="messageType" @change="showOrHideCharacterCount" name="channel" class="form-control {{ $errors->has('channel') ? ' is-invalid' : '' }}">
                                    {{--  <option value="">Select Channel</option>  --}}
                                    @if($channelTypes = \App\Essentials\MessageChannel::getArray())
                                        @foreach ($channelTypes as $typeKey => $typeValue)
                                            @if(($typeKey == 'sms') && (settings('ACTIVATE_SMS') == true))
                                            <option value="{{$typeKey}}" {{(old('channel') == $typeKey) ? 'selected' : ''}}>{{$typeValue}}</option>
                                            @endif
                                            @if(($typeKey == 'email') && (settings('ACTIVATE_EMAIL') == true))
                                            <option value="{{$typeKey}}" {{(old('channel') == $typeKey) ? 'selected' : ''}}>{{$typeValue}}</option>
                                            @endif
                                        {{-- <option value="{{$typeKey}}" {{(old('channel') == $typeKey) ? 'selected' : ''}} {{(($typeKey == 'sms') && (settings('ACTIVATE_SMS') != true)) ? 'disabled' : ''}} {{(($typeKey == 'email') && (settings('ACTIVATE_EMAIL') != true)) ? 'disabled' : ''}}>{{$typeValue}}</option> --}}
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('channel'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('channel') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="recepient">Recepients</label>
                                <select v-model="recepient" @change="updateRecepientCount" name="recepient" class="form-control {{ $errors->has('recepient') ? ' is-invalid' : '' }}">
                                    <option value="">Select Recepient</option>
                                    @if($messageRecepients = \App\Essentials\MessageRecipient::getArray())
                                        @foreach ($messageRecepients as $recepientKey => $recepientValue)
                                        <option value="{{$recepientKey}}" {{(old('recepient') == $recepientKey) ? 'selected' : ''}}>{{$recepientValue}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('recepient'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('recepient') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content">Message Content</label>
                            <textarea type="text" class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}" v-model="message" placeholder="Type your message here" name="content" id="content">{{old('content')}}</textarea>
                            <span v-if="showCharacterCount">@{{message.length}} / @{{smsCount}} sms</span>
                            <span v-if="canSend && (messageType == 'sms')" style="color:saddlebrown">
                                | You do not have enough SMS
                            </span>
                                @if ($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif

                        </div>
                        <div class="form-group">
                            <button :disabled="canSend" type="submit" class="btn btn-primary btn-block btn-sm">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@if (auth()->user()->hasPermission('edit_message'))
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
        <script>
            data = {
                SMSRemaining: {{settings('SMS_REMAINING')}},
                allUserCount: {{\App\User::count()}},
                residentCount: {{\App\Resident::count()}},
                landlordCount: {{\App\Landlord::count()}},
                recepient: '',
                recepientCount: 1,
                message: '',
                messageType: 'email',
                showCharacterCount: false
            }

            new Vue({
                el: '#messaging',
                data: data,
                methods: {
                    showOrHideCharacterCount() {
                        if(data.messageType == 'sms'){
                            data.showCharacterCount = true;
                        }else{
                            data.showCharacterCount = false;
                        }
                    },
                    updateRecepientCount() {
                        if(data.recepient == 'all'){
                            data.recepientCount = data.allUserCount;
                        }
                        if(data.recepient == 'resident'){
                            data.recepientCount = data.residentCount;
                        }
                        if(data.recepient == 'landlord'){
                            data.recepientCount = data.landlordCount;
                        }
                    },
                },
                computed: {
                    canSend() {
                        return data.SMSRemaining < (Math.ceil(data.message.length / 145) * data.recepientCount);
                    },
                    smsCount() {
                        return Math.ceil(data.message.length / 145);
                    }
                }
            })
        </script>
    @endsection
@endif
