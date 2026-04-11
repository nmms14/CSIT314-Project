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

    def validate_session(self, request):
        """Check if the current session has an authenticated user.

        Returns:
            PlatformManager or None
        """
        if request.user.is_authenticated:
            return request.user
        return None
