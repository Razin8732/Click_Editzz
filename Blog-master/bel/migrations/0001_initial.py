# Generated by Django 3.0.2 on 2020-01-05 12:38

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Blog',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('title', models.CharField(max_length=200)),
                ('subtitle', models.CharField(blank=True, max_length=200, null=True)),
                ('blog', models.TextField()),
                ('created_at', models.DateTimeField(auto_now_add=True)),
                ('modified_at', models.DateTimeField(auto_now=True)),
            ],
            options={
                'verbose_name': 'blog',
                'verbose_name_plural': 'blogs',
            },
        ),
        migrations.CreateModel(
            name='Blogger',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('username', models.CharField(max_length=30, unique=True)),
                ('password', models.CharField(max_length=30)),
            ],
            options={
                'verbose_name': 'blogger',
                'verbose_name_plural': 'bloggers',
            },
        ),
        migrations.CreateModel(
            name='Comment',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('comment', models.CharField(max_length=300)),
                ('created_at', models.DateTimeField(auto_now_add=True)),
                ('blog', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='Commentblog', to='bel.Blog')),
                ('blogger', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='Commentblogger', to='bel.Blogger')),
                ('responseComment', models.ForeignKey(blank=True, null=True, on_delete=django.db.models.deletion.CASCADE, related_name='rcomment', to='bel.Comment')),
            ],
            options={
                'verbose_name': 'Comment',
                'verbose_name_plural': 'Comments',
            },
        ),
        migrations.AddField(
            model_name='blog',
            name='blogger',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='bel.Blogger'),
        ),
    ]
