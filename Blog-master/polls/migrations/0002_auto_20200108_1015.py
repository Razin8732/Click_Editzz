# Generated by Django 3.0.2 on 2020-01-08 10:15

from django.db import migrations, models
import polls.models


class Migration(migrations.Migration):

    dependencies = [
        ('polls', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='poll',
            name='expires_at',
            field=models.DateTimeField(default=polls.models.Poll.get_expiredate),
        ),
    ]
