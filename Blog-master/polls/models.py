from django.db import models
from django.urls import reverse
from datetime import datetime, timedelta 
from django.utils import timezone
from django.utils.translation import gettext as _
# Create your models here.
class Admin(models.Model):
    username = models.CharField(max_length=30)
    password = models.CharField(max_length=30)

    class Meta:
        verbose_name = _("admin")
        verbose_name_plural = _("admins")

    def __str__(self):
        return self.username

    def get_absolute_url(self):
        return reverse("admin_detail", kwargs={"pk": self.pk})

class User(models.Model):
    username = models.CharField(max_length=30)
    password = models.CharField(max_length=30)

    class Meta:
        verbose_name = _("user")
        verbose_name_plural = _("users")

    def __str__(self):
        return self.username

    def get_absolute_url(self):
        return reverse("user_detail", kwargs={"pk": self.pk})

class Poll(models.Model):
    def get_expiredate():
        return timezone.now() + timedelta(days=1)

    poll = models.CharField(max_length=200)
    created_at = models.DateTimeField(auto_now_add=True)
    expires_at = models.DateTimeField(default = get_expiredate)
    owner = models.ForeignKey("User", on_delete=models.CASCADE)
    category = models.ForeignKey("Category",on_delete=models.SET_NULL,null=True,blank=True)

    class Meta:
        verbose_name = _("poll")
        verbose_name_plural = _("polls")

    def __str__(self):
        return self.poll

    def get_absolute_url(self):
        return reverse("poll_detail", kwargs={"pk": self.pk})

class Choice(models.Model):

    choice = models.CharField(max_length=50)
    vote = models.IntegerField(default=0)
    poll = models.ForeignKey("Poll", on_delete=models.CASCADE)
    class Meta:
        verbose_name = _("Choice")
        verbose_name_plural = _("Choices")

    def __str__(self):
        return self.choice

    def get_absolute_url(self):
        return reverse("Choice_detail", kwargs={"pk": self.pk})

class Category(models.Model):

    category = models.CharField(max_length=50,unique=True)

    class Meta:
        verbose_name = _("category")
        verbose_name_plural = _("categories")
        ordering = ['category']
    def __str__(self):
        return self.category

    def get_absolute_url(self):
        return reverse("category_detail", kwargs={"pk": self.pk})

class Vote(models.Model):

    user = models.ForeignKey("User", on_delete=models.CASCADE,related_name="userwhovote")
    poll = models.ForeignKey("Poll", on_delete=models.CASCADE,related_name="pollonwhichvote")

    class Meta:
        verbose_name = _("vote")
        verbose_name_plural = _("votes")

    def __str__(self):
        return self.poll.poll+"-"+self.user.username

    def get_absolute_url(self):
        return reverse("vote_detail", kwargs={"pk": self.pk})

