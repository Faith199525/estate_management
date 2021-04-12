@extends('layouts.app')
@section('content')
<div class="container">
    <div class="content-header row mb-1">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Guide and FAQ
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center mb-1">
        <div class="col-md-9">
            <h3>Guides & FAQ</h3>
        </div>
    </div>

    <div class="card">
        <div id="headingCollapse1"  class="card-header">
            <a data-toggle="collapse" href="#collapse1" aria-expanded="true" aria-controls="collapse1" class="card-title lead">How do I complete my "landlord profile"?</a>
        </div>
        <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="card-collapse collapse in" aria-expanded="true">
            <div class="card-body">
                <div class="card-block">
                    <span> To complete your landlord profile, follow this steps:</span>
                    <ul>
                        <li>Click on <strong>"Landlord"</strong> on the sidebar.</li>
                        <li>Select <strong>"Landlord's Profile"</strong> from the list.<i> This would take you to your profile page as a landlord.</i></li>
                        <li>On this landlord page, click in the <strong>"Edit"</strong> button. <i> This would take you to the edit form</i></li>
                        <li>Once there, fill the form with your details</li>
                        <li>Click on <strong>"Submit"</strong></li>
                    </ul>
                    <i>Landlord -> Landlord profile -> Edit (button) -> Fill Form -> Submit</i>
                </div>
            </div>
        </div>
        <div id="headingCollapse2"  class="card-header">
            <a data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2" class="card-title lead collapsed">How do I Add properties</a>
        </div>
        <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
                <div class="card-block">
                    <span> To add a property, follow this steps:</span>
                    <ul>
                        <li>Click on <strong>"Landlord"</strong> on the sidebar.</li>
                        <li>Select <strong>"View Properties"</strong> from the list.<i> This would take you to your properties page.</i></li>
                        <li>On this properties page, click in the <strong>"Add new Property"</strong> button. <i> This would bring out a form</i></li>
                        <li>Fill the form with accurate details</li>
                        <li>Submit the form</li>
                    </ul>
                    <i>Landlord -> View Properties -> Add New Properties (button) -> Fill Form -> Submit</i>
                </div>
            </div>
        </div>
        <div id="headingCollapse3"  class="card-header">
            <a data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse3" class="card-title lead collapsed">How do I Invite Residents to portal</a>
        </div>
        <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
                <div class="card-block">
                    <span> To invite residents, follow this steps:</span>
                    <ul>
                        <li>Click on <strong>"Landlord"</strong> on the sidebar.</li>
                        <li>Select <strong>"Invite Residents"</strong> from the list.<i> This would take you to the invite page.</i></li>
                        <li>On this invite page, provide the email addresses of your tenants and <strong>separate the emails by coma (,)</strong>.
                            <br>
                            <i><strong>Note:</strong> These residents must be staying on the same property. <i class="e">Residents on different properties must be invited separately</i></i>
                        </li>
                        <li>Select the property these residents are staying.</li>
                        <li>Submit the form</li>
                    </ul>
                    <i>Landlord -> Invite Residents -> Fill Form (with Emails) -> Select Property -> Submit</i>
                </div>
            </div>
        </div>
        <div id="headingCollapse4"  class="card-header">
            <a data-toggle="collapse" href="#collapse4" aria-expanded="false" aria-controls="collapse4" class="card-title lead collapsed">How do I Activate my Resident Profile (Only for resident landlords)
            </a>
        </div>
        <div id="collapse4" role="tabpanel" aria-labelledby="headingCollapse4" class="card-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="card-body">
                <div class="card-block">
                    <span> To activate your resident profile, follow this steps:</span>
                    <ul>
                        <li>Click on <strong>"Home"</strong> on the sidebar.</li>
                        <li>On this page, you would see instructions that says <strong>"Click here" to activate your resident profile.</strong> Click it.</li>
                        <li>This would open up a form. On this form, select the property in which you reside as landlord.</li>
                        <li>Submit the form</li>
                    </ul>
                    <i>Home -> click on "Click here" -> Select your residence in Form -> Submit</i>
                </div>
            </div>
        </div>
        <div id="headingCollapse5"  class="card-header">
            <a data-toggle="collapse" href="#collapse5" aria-expanded="false" aria-controls="collapse5" class="card-title lead collapsed">Where do I Complete my resident profile</a>
        </div>
        <div id="collapse5" role="tabpanel" aria-labelledby="headingCollapse5" class="card-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="card-body">
                <div class="card-block">
                    <span> To complete your resident profile, follow this steps:</span>
                    <ul>
                        <li>Click on <strong>"Resident"</strong> on the sidebar.</li>
                        <li>Select <strong>"Your Resident profile"</strong> from the list.<i> This would take you to your profile page as a resident.</i></li>
                        <li>On this resident page, click in the <strong>"Edit"</strong> button. <i> This would take you to the edit form</i></li>
                        <li>Once there, fill the form with your details</li>
                        <li>Click on <strong>"Submit"</strong></li>
                    </ul>
                    <i>Resident -> Your Resident profile -> Edit (button) -> Fill Form -> Submit</i>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
