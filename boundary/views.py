from django.shortcuts import render, redirect

from control.auth_manager import AuthenticationManager


auth_manager = AuthenticationManager()


def landing_view(request):
    """Boundary layer: Renders the public landing page."""
    return render(request, 'landing.html')


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


def signup_view(request):
    """Boundary layer: Handles signup HTTP requests and renders signup form."""
    if auth_manager.validate_session(request):
        return redirect('dashboard')

    context = {}
    if request.method == 'POST':
        first_name = request.POST.get('first_name', '')
        last_name = request.POST.get('last_name', '')
        email = request.POST.get('email', '')
        password = request.POST.get('password', '')
        confirm_password = request.POST.get('confirm_password', '')

        success, error = auth_manager.signup(
            request, first_name, last_name, email, password, confirm_password
        )
        if success:
            return redirect('dashboard')

        context = {
            'error': error,
            'first_name': first_name,
            'last_name': last_name,
            'email': email,
        }

    return render(request, 'signup.html', context)


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
