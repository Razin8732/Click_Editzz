from django.contrib import admin
from  .models import Enduser,Instructor,Admin,Course,EndusersCourse,PaymentByUser,PaymentToInstructor
# Register your models here.
admin.site.register(Enduser)
admin.site.register(Instructor)
admin.site.register(Admin)
admin.site.register(Course)
admin.site.register(EndusersCourse)
admin.site.register(PaymentByUser)
admin.site.register(PaymentToInstructor)