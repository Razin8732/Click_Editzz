from django.shortcuts import render
from .models import Enduser, Instructor, Admin, Course, EndusersCourse, PaymentByUser, PaymentToInstructor
from django.core.validators import validate_email
from django.db import IntegrityError
from django.shortcuts import redirect
import random
from django.http import JsonResponse
from django.core.exceptions import ValidationError
# Create your views here.


def index(request):
    if 'brainery_username' in request.session:
        username = request.session['brainery_username']
        email = request.session['brainery_email']
        auth = True
        enduser = Enduser.objects.filter(email=email).first()
        endusercoursesid = EndusersCourse.objects.filter(
            enduser=enduser).values_list('course_id', flat=True)
        courses = Course.objects.exclude(id__in=endusercoursesid)
    else:
        auth = False
        username = ""
        courses = Course.objects.all()
    return render(request, 'brainery/index.html', {'auth': auth,'username': username,'courses': courses })


def register(request):
    if 'brainery_username' in request.session:
        return redirect('brainery-home')
    else:
        if request.method == 'POST':
            email = request.POST.get("remail", "")
            name = request.POST.get("rname", "")
            password = request.POST.get("rpassword", "")

            try:
                validate_email(email)
            except ValidationError:
                error = "Email address is wrong"
                return render(request, 'brainery/registererror.html', {"error": error})

            if len(name) > 30 or len(name) < 4 or len(password) > 30 or len(password) < 4:
                error = "Name and password should be min 4 and max 30 character longer."
                return render(request, 'brainery/registererror.html', {"error": error})

            try:
                enduser = Enduser(email=email, name=name, password=password)
                enduser.save()
                request.session['brainery_username'] = name
                request.session['brainery_email'] = email
                return redirect('brainery-home')
            except IntegrityError:
                error = "User with this email already exist"
                return render(request, 'brainery/registererror.html', {"error": error})
        else:
            return redirect('brainery-home')


def login(request):
    if 'brainery_username' in request.session:
        return redirect("qna-home")
    else:
        if request.method == 'POST':
            email = request.POST.get("lemail", "")
            password = request.POST.get("lpassword", "")

            try:
                validate_email(email)
            except ValidationError:
                error = "Email address is wrong"
                return render(request, 'brainery/registererror.html', {"error": error})

            enduser = Enduser.objects.filter(
                email=email, password=password).first()

            if enduser:
                request.session['brainery_username'] = enduser.name
                request.session['brainery_email'] = enduser.email
                return redirect('brainery-home')
            else:
                error = "Invalid email or password"
                return render(request, 'brainery/registererror.html', {"error": error})
        else:
            return redirect('brainery-home')


def logout(request):
    if 'brainery_username' in request.session:
        del request.session['brainery_username']
        del request.session['brainery_email']
    return redirect('brainery-home')


def buycourse(request, pk):
    if 'brainery_username' in request.session:
        username = request.session['brainery_username']
        auth = True
    else:
        auth = False
        username = ""
    course = Course.objects.get(pk=pk)

    return render(request, 'brainery/buy-course.html', {'auth': auth, 'course': course, 'username': username})


def buycoursepayment(request, pk):
    if 'brainery_username' in request.session:
        auth = True
        username = request.session['brainery_username']
        email = request.session['brainery_email']
        course = Course.objects.get(pk=pk)
        enduser = Enduser.objects.filter(email=email).first()

        if course.status == 'f':
            usercourse = EndusersCourse(enduser=enduser, course=course)
            usercourse.save()
            payment = PaymentByUser(
                enduser=enduser, course=course, amount=course.amount)
            payment.save()
            return redirect('brainery-home')
        if request.method == 'POST':

            number = request.POST.get("number", "")
            month = int(request.POST.get("month", ""))
            year = int(request.POST.get("year", ""))
           
            if len(number) != 12:
                error = "Card number is wrong"
                return render(request, 'brainery/buy-course-payment.html', {'auth': auth, 'course': course, 'username': username, 'error': error})

            if month < 0 or month > 12:
                error = "Month is wrong"
                return render(request, 'brainery/buy-course-payment.html', {'auth': auth, 'course': course, 'username': username, 'error': error})

            if year < 2020 or month > 2028:
                error = "Year is wrong"
                return render(request, 'brainery/buy-course-payment.html', {'auth': auth, 'course': course, 'username': username, 'error': error})

            
            usercourse = EndusersCourse(enduser=enduser, course=course)
            usercourse.save()
            payment = PaymentByUser(
                enduser=enduser, course=course, amount=course.amount)
            payment.save()
            return redirect('brainery-home')
        else:
            return render(request, 'brainery/buy-course-payment.html', {'auth': auth, 'course': course, 'username': username})
    else:
        return redirect('brainery-home')


def courseopen(request, pk):
    if 'brainery_username' in request.session:
        auth = True
        username = request.session['brainery_username']
        course = Course.objects.get(pk=pk)
        return render(request, 'brainery/course.html', {'auth': auth, 'course': course, 'username': username})

    else:
        return redirect('brainery-home')
