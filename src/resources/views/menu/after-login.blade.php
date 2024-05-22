<div class="menu">
    <div class="modal-back">
        <a class="modal-back__button" href="#">&times;</a>
    </div>
    <div class="menu-content">
        <div class="menu-item">
            <a class="menu-item__link" href="{{ route('index') }}">Home</a>
        </div>
        <div class="menu-item">
            <form class="logout-form" action="/logout" method="post">
                @csrf
                <button class="logout-button" type="submit">Logout</button>
            </form>
        </div>
        <div class="menu-item">
            <a class="menu-item__link" href="{{ route('linkUser') }}">Mypage</a>
        </div>
        @if(isset($user) && $user['role'] == 'company')
        <div class="menu-item">
            <a class="menu-item__link" href="{{ route('multiIndex') }}">ManagementLogin</a>
        </div>
        @endif
    </div>
</div>