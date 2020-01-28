from django.db import models
from django.urls import reverse
# Create your models here.
class Blogger(models.Model):

    username = models.CharField(unique=True,max_length=30)
    password = models.CharField(max_length=30)

    class Meta:
        verbose_name = "blogger"
        verbose_name_plural ="bloggers"

    def __str__(self):
        return self.username

    def get_absolute_url(self):
        return reverse("blogger_detail", kwargs={"pk": self.pk})

class Blog(models.Model):
    title = models.CharField(max_length=200,unique=True)
    subtitle = models.CharField(max_length=200,null=True,blank=True)
    blog = models.TextField()
    created_at = models.DateTimeField(auto_now_add=True)
    modified_at = models.DateTimeField(auto_now=True)
    blogger = models.ForeignKey("Blogger", on_delete=models.CASCADE)
    
    class Meta:
        verbose_name = "blog"
        verbose_name_plural = "blogs"

    def __str__(self):
        return self.title

    def get_absolute_url(self):
        return reverse("blog", kwargs={"pk": self.pk})


class Comment(models.Model):

    comment = models.CharField(max_length=300)
    blog = models.ForeignKey("Blog", on_delete=models.CASCADE,related_name="Commentblog")
    blogger = models.ForeignKey("Blogger", on_delete=models.CASCADE,related_name="Commentblogger")
    responseComment = models.ForeignKey("self", on_delete=models.CASCADE,related_name="rcomment",null=True,blank=True)
    created_at = models.DateTimeField(auto_now_add=True)
    isResponce = models.BooleanField(default=False)
    class Meta:
        verbose_name = "Comment"
        verbose_name_plural = "Comments"

    def __str__(self):
        return self.comment+"("+self.blogger.username+")"

    def get_absolute_url(self):
        return reverse("Comment_detail", kwargs={"pk": self.pk})
