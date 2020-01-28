from django.contrib import admin
from django.urls import path,include
from django.views.generic import RedirectView
from django.conf import settings
from django.conf.urls.static import static


urlpatterns = [
    path('admin/', admin.site.urls),
]
# Use include() to add paths from the catalog application 
urlpatterns += [
    path('bel/', include('bel.urls')),
]
#Add URL maps to redirect the base URL to our application
urlpatterns += [
    path('', RedirectView.as_view(url='bel/', permanent=True)),
]
urlpatterns += [
    path('polls/', include('polls.urls')),
]
urlpatterns += [
    path('brainery/', include('brainery.urls')),
]
urlpatterns += static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
