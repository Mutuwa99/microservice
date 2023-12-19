# user_management/views.py

from django.shortcuts import render
from django.http import JsonResponse
from django.views.decorators.csrf import csrf_exempt
from .models import CustomUser
import json

@csrf_exempt
def signup(request):
    if request.method == 'POST':
        try:
            data = json.loads(request.body.decode('utf-8'))
            print("Received data:", data)  # Add this line for debugging
            username = data.get('username', '')
            email = data.get('email', '')
            city = data.get('city', '')
            gender = data.get('gender', '')
            
            # Check if user with the given email already exists
            existing_user = CustomUser.objects.filter(email=email).first()

            if existing_user:
                response_data = {
                    'message': 'User with this email already exists',
                }
                print("User is already there")
            else:
                # Create a new user instance and save it to the database
                new_user = CustomUser.objects.create(
                    username=username,
                    email=email,
                    city=city,
                    gender=gender,
                    # Add other fields as needed
                )

                response_data = {
                    'message': 'Signup successful',
                    'username': new_user.username,
                    'email': new_user.email,
                    'city': new_user.city,
                    'gender': new_user.gender,
                }

                print("New user created")

            return JsonResponse(response_data)
        except json.JSONDecodeError as e:
            return JsonResponse({'error': 'Invalid JSON format'}, status=400)

    return JsonResponse({'error': 'Invalid request method'}, status=405)
