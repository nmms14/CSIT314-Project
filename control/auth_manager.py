from django.contrib.auth import authenticate, login, logout

from entity.models import PlatformManager


class AuthenticationManager:
    """Control layer: Handles all authentication business logic."""

    def login(self, request, email, password):
        """Validate credentials and create session.

        Returns:
            (bool, str): Tuple of (success, error_message).
        """
        if not email or not password:
            return False, "Email and password are required."

        try:
            user = PlatformManager.objects.get(email=email)
        except PlatformManager.DoesNotExist:
            return False, "Invalid email or password."

        user = authenticate(request, username=user.username, password=password)
        if user is None:
            return False, "Invalid email or password."

        login(request, user)
        return True, ""

    def logout(self, request):
        """Destroy session and clear authentication state."""
        logout(request)

    def signup(self, request, first_name, last_name, email, password, confirm_password):
        """Validate input and create a new user account.

        Returns:
            (bool, str): Tuple of (success, error_message).
        """
        if not first_name or not last_name or not email or not password:
            return False, "All fields are required."

        if password != confirm_password:
            return False, "Passwords do not match."

        if len(password) < 8:
            return False, "Password must be at least 8 characters."

        if PlatformManager.objects.filter(email=email).exists():
            return False, "An account with this email already exists."

        user = PlatformManager.objects.create_user(
            username=email,
            email=email,
            password=password,
            first_name=first_name,
            last_name=last_name,
        )
        login(request, user)
        return True, ""

    def validate_session(self, request):
        """Check if the current session has an authenticated user.

        Returns:
            PlatformManager or None
        """
        if request.user.is_authenticated:
            return request.user
        return None
