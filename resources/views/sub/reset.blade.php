@component('mail::message')
# Introduction

We have recieved a request for reset password.

@component('mail::button', ['url' => url('http://kids.dev/spassword/reset/'.$data['token'])])
Click here to reset password Now
@endcomponent

Thanks,<br>
Kids-Rehab
@endcomponent