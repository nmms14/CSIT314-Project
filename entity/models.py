from django.contrib.auth.models import AbstractUser
from django.db import models


class PlatformManager(AbstractUser):
    """Entity layer: Domain model for Platform Manager user."""

    ROLE_CHOICES = [
        ('platform_manager', 'Platform Manager'),
    ]

    role = models.CharField(max_length=30, choices=ROLE_CHOICES, default='platform_manager')

    class Meta:
        db_table = 'platform_manager'

    def get_role_display_name(self):
        return dict(self.ROLE_CHOICES).get(self.role, self.role)
