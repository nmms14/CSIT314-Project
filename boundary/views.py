from django.shortcuts import render, redirect

from control.auth_manager import AuthenticationManager


auth_manager = AuthenticationManager()


def login_view(request):
    """Boundary layer: Handles login HTTP requests and renders login form."""
    if auth_manager.validate_session(request):
        return redirect('dashboard')

    error = ""
    if request.method == 'POST':
        email = request.POST.get('email', '')
        password = request.POST.get('password', '')
        success, error = auth_manager.login(request, email, password)
        if success:
            return redirect('dashboard')

    return render(request, 'login.html', {'error': error})


def dashboard_view(request):
    """Boundary layer: Renders dashboard for authenticated users only."""
    user = auth_manager.validate_session(request)
    if not user:
        return redirect('login')

    return render(request, 'dashboard.html', {
        'name': user.get_full_name() or user.username,
        'role': user.get_role_display_name(),
    })


def logout_view(request):
    """Boundary layer: Handles logout and redirects to login."""
    auth_manager.logout(request)
    return redirect('login')
