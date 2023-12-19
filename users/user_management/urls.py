# user_management/urls.py

from django.urls import path
from .views import signup

urlpatterns = [
    # path('profile/', user_profile, name='user_profile'),
    path('signup/', signup, name='signup'),
    # Add more paths as needed
]
