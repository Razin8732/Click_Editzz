from django.urls import path
from . import views

urlpatterns = [
    path("admin/login/",views.loginAdmin,name="polls-login-admin"),
    path("admin/logout/",views.logoutAdmin,name="polls-logout-admin"),
    path("admin/",views.indexAdmin,name="polls-admin-home"),
    path("admin/addcategory/",views.addCategoryAdmin,name="poll-admin-category-add"),

    path("",views.index,name="polls-home"),
    path("register/",views.register,name="polls-register"),
    path("login/",views.login,name="polls-login"),
    path("logout/",views.logout,name="polls-logout"),
    path("addpoll/",views.addpoll,name="poll-add"),
    path("poll/<int:pk>",views.pollvote,name="poll"),
    path("poll/<int:pk>/result",views.pollresult,name="poll-result"),
    path("profile/",views.profile,name="poll-profile"),
]