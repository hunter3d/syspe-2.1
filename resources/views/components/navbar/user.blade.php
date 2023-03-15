@php
    $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
@endphp
<a class="nav-link dropdown-toggle text-white p-0" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fal fa-user"></i>
</a>
<ul class="dropdown-menu dropdown-menu-end">
    <li>
        <span class="px-3 text-muted">{{ $user->email }}</span>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li>
        <a class="dropdown-item" href="/auth/logout">
            <i class="fal fa-sign-out fa-fw text-primary"></i> Выход
        </a>
    </li>
</ul>
