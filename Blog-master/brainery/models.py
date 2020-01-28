from django.db import models
from django.urls import reverse  # Used to generate URLs by reversing the URL patterns
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.utils.translation import gettext as _

# Create your models here.
class Enduser(models.Model):

    name = models.CharField(max_length=30)
    email = models.EmailField(max_length=254,unique=True)
    password = models.CharField(max_length=30)
    created_at = models.DateTimeField(auto_now_add=True)
    
    class Meta:
        verbose_name = _("enduser")
        verbose_name_plural = _("endusers")

    def __str__(self):
        return self.name

    def get_absolute_url(self):
        return reverse("enduser_detail", kwargs={"pk": self.pk})


class Instructor(models.Model):

    name = models.CharField(max_length=30)
    email = models.EmailField(max_length=254,unique=True)
    password = models.CharField(max_length=30)
    created_at = models.DateTimeField(auto_now_add=True)
    
    class Meta:
        verbose_name = _("instructor")
        verbose_name_plural = _("instructors")

    def __str__(self):
        return self.name

    def get_absolute_url(self):
        return reverse("instructor_detail", kwargs={"pk": self.pk})


class Admin(models.Model):

    name = models.CharField(max_length=30)
    email = models.EmailField(max_length=254,unique=True)
    password = models.CharField(max_length=30)
    created_at = models.DateTimeField(auto_now_add=True)
    
    class Meta:
        verbose_name = _("admin")
        verbose_name_plural = _("admins")

    def __str__(self):
        return self.name

    def get_absolute_url(self):
        return reverse("admin_detail", kwargs={"pk": self.pk})

class Course(models.Model):
    
    STATUS_CHOICES=(
        ("f","Free"),
        ("p","Paid"),
    )

    instructor = models.ForeignKey("Instructor",on_delete=models.SET_DEFAULT,default=1)
    title = models.CharField(max_length=100)
    description = models.TextField()
    learn = models.TextField()
    prereq = models.TextField()
    status = models.CharField(max_length=20,choices=STATUS_CHOICES)
    amount = models.IntegerField(default=0)
    created_at = models.DateTimeField(auto_now_add=True)

    class Meta:
        verbose_name = _("Course")
        verbose_name_plural = _("Courses")

    def __str__(self):
        return self.title

    def get_absolute_url(self):
        return reverse("Course_detail", kwargs={"pk": self.pk})

class EndusersCourse(models.Model):

    enduser = models.ForeignKey("Enduser",  on_delete=models.CASCADE)
    course = models.ForeignKey("Course",  on_delete=models.CASCADE)
    created_at = models.DateTimeField(auto_now_add=True)

    class Meta:
        verbose_name = _("EndusersCourse")
        verbose_name_plural = _("EndusersCourses")

    def __str__(self):
        return str(self.id)

    def get_absolute_url(self):
        return reverse("EndusersCourse_detail", kwargs={"pk": self.pk})

class PaymentByUser(models.Model):

    enduser = models.ForeignKey("Enduser",  on_delete=models.SET_NULL,null=True,blank=True)
    course = models.ForeignKey("Course",  on_delete=models.SET_NULL,null=True,blank=True)
    amount = models.IntegerField(default=0)
    created_at = models.DateTimeField(auto_now_add=True)
    
    class Meta:
        verbose_name = _("PaymentByUser")
        verbose_name_plural = _("PaymentByUsers")

    def __str__(self):
        return str(self.id)

    def get_absolute_url(self):
        return reverse("PaymentByUser_detail", kwargs={"pk": self.pk})

class PaymentToInstructor(models.Model):

    enduser = models.ForeignKey("Enduser",  on_delete=models.SET_NULL,null=True,blank=True)
    course = models.ForeignKey("Course",  on_delete=models.SET_NULL,null=True,blank=True)
    amount = models.IntegerField(default=0)
    created_at = models.DateTimeField(auto_now_add=True)
    
    class Meta:
        verbose_name = _("PaymentToInstructor")
        verbose_name_plural = _("PaymentToInstructors")

    def __str__(self):
        return str(self.id)

    def get_absolute_url(self):
        return reverse("PaymentToInstructor_detail", kwargs={"pk": self.pk})
