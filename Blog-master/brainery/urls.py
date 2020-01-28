from django.urls import path
from . import views

urlpatterns = [
    path("",views.index,name="brainery-home"),
    path("register/",views.register,name="brainery-register"),
    path("login/",views.login,name="brainery-login"),
    path("logout/",views.logout,name="brainery-logout"),
    path("buycourse/<int:pk>",views.buycourse,name="brainery-course-buy"),
    path("buycourse/<int:pk>/payment",views.buycoursepayment,name="brainery-course-buy-payment"),
    
]
