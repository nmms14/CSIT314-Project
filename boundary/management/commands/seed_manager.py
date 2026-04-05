from django.core.management.base import BaseCommand

from entity.models import PlatformManager


class Command(BaseCommand):
    help = 'Seed the database with a Platform Manager account'

    def handle(self, *args, **options):
        email = 'manager@fundraising.com'

        if PlatformManager.objects.filter(email=email).exists():
            self.stdout.write(self.style.WARNING(f'Platform Manager "{email}" already exists.'))
            return

        PlatformManager.objects.create_user(
            username='manager',
            email=email,
            password='manager123',
            first_name='Platform',
            last_name='Manager',
            role='platform_manager',
        )
        self.stdout.write(self.style.SUCCESS(f'Platform Manager "{email}" created successfully.'))
