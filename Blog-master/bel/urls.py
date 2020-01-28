from django.urls import path
from . import views

urlpatterns = [
    path("",views.index,name="blog-home"),
    path("register/",views.register,name="blogger-register"),
    path("login/",views.login,name="blogger-login"),
    path("logout/",views.logout,name="blogger-logout"),
    path("blog/<int:pk>/",views.blog,name="blog"),
    path("blog/add/",views.blogadd,name="blog-add"),
    path("blog/<int:pk>/edit/",views.blogedit,name="blog-edit"),
    path("blog/<int:pk>/delete/",views.blogdelete,name="blog-delete"),
    path("blog/<int:blog>/addcomment",views.blogcommentadd,name="blog-comment-add"),
    path("blog/<int:blog>/comment/<int:comment>/responsecomment",views.blogcommentresponse,name="blog-comment-response"),
    path("profile/",views.profile,name="blog-profile"),
]