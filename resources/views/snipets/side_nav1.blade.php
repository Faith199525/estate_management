            <ul class="list-group">
                <a href="/home" class="list-group-item">Home</a>
                <a href="/dues" class="list-group-item">Dues & Payments</a>
            @if (\Auth::user()->landlord)
                <a href="/landlords-profile" class="list-group-item">Landlords Profile</a>
                <a href="/properties" class="list-group-item">View Properties</a>
                <a href="/residents/invite" class="list-group-item">Invite Residents</a>
            @endif
            @if (\Auth::user()->residents->isNotEmpty())
                <a href="/resident-profile" class="list-group-item">Your Resident Profile</a>
            @endif
            </ul>
