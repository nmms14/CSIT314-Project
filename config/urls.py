from django.contrib import admin
from django.urls import path

from boundary.views import landing_view, login_view, dashboard_view, logout_view

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', landing_view, name='landing'),
    path('login/', login_view, name='login'),
    path('dashboard/', dashboard_view, name='dashboard'),
    path('logout/', logout_view, name='logout'),
]
