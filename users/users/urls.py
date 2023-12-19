# your_project/urls.py

from django.contrib import admin
from django.urls import path, include
from user_management import views as user_management_views

urlpatterns = [
    path('admin/', admin.site.urls),
    path('auth/', include('user_management.urls')),  # Include user-related URLs under the '/user/' path

]
