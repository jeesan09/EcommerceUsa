<p>Dear Admin,</p>

<p>A new user has registered:</p>

<ul>
    <li>Name: {{ $user->name }}</li>
    <li>Reseller ID: {{ $user->reseller_ID }}</li>
    <li>Company Name: {{ $user->company_name }}</li>
    <li>Email: {{ $user->email }}</li>
    <li>Shippping Address: {{ $user->shipping_address }}</li>
    <li>Phone: {{ $user->phone }}</li>
</ul>

<p>Click <a href="{{ $activationLink }}">here</a> to view the user list.</p>

<p>Thank you,</p>
<p>MPW Wholesale</p>
