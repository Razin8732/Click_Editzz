from django.contrib import admin
from .models import Admin,User,Poll,Choice,Category,Vote
# Register your models here.
admin.site.register(Admin)
admin.site.register(User)
admin.site.register(Poll)
admin.site.register(Choice)
admin.site.register(Category)
admin.site.register(Vote)
