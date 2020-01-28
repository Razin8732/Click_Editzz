from django.shortcuts import render
from .models import Blogger, Blog, Comment
from django.db import IntegrityError
from django.shortcuts import redirect
import random


def index(request):
    if 'bel_username' in request.session:
        auth = True
        username = request.session['bel_username']
    else:
        auth = False
        username = ""

    blogs = sorted(Blog.objects.all(), key=lambda x: random.random())
    return render(request, 'bel/index.html', {'auth': auth,'username': username, 'blogs': blogs})


def register(request):
    if 'bel_username' in request.session:
        return redirect("blog-home")
    else:
        if request.method == 'POST':
            username = request.POST.get("username", "")
            password = request.POST.get("password", "")

            if len(username) == 0 or len(username) > 30 or len(password) == 0 or len(password) > 30:
                error = "Can't be empty and max 30 character longer."
                return render(request, 'bel/register.html', {"error": error})

            try:
                user = Blogger(username=username, password=password)
                user.save()
                request.session['bel_username'] = username
                return redirect("blog-home")
            except IntegrityError:
                error = "Username already exist with same username"
                return render(request, 'bel/register.html', {"error": error})
        else:
            return render(request, 'bel/register.html')


def login(request):
    if 'bel_username' in request.session:
        return redirect("blog-home")
    else:
        if request.method == 'POST':
            username = request.POST.get("username", "")
            password = request.POST.get("password", "")

            if len(username) == 0 or len(username) > 30 or len(password) == 0 or len(password) > 30:
                error = "Can't be empty and max 30 character longer."
                return render(request, 'bel/login.html', {"error": error})

            user = Blogger.objects.filter(username=username, password=password).first()

            if user:
                request.session['bel_username'] = username
                return redirect("blog-home")
            else:
                error = "Invalid username or password"
                return render(request, 'bel/login.html', {"error": error})
        else:
            return render(request, 'bel/login.html')


def logout(request):
    if 'bel_username' in request.session:
        del request.session['bel_username']
    return redirect("blog-home")


def blog(request, pk):
    if 'bel_username' in request.session:
        auth = True
        username = request.session['bel_username']
    else:
        auth = False
        username = ""

    blog = Blog.objects.get(pk=pk)
    comments = Comment.objects.filter(blog=blog, isResponce=False)
    
    if blog.blogger.username == username:
        sameUser = True
    else:
        sameUser = False

    return render(request, 'bel/blog.html', {'auth': auth, 'username': username,'blog': blog, 'comments': comments,  'sameUser': sameUser})


def blogadd(request):
    if 'bel_username' in request.session:
        auth = True
        username = request.session['bel_username']
        if request.method == 'POST':

            isError = False
            titleError = False
            subtitleError = False
            blogError = False
            title = request.POST.get("title", "")
            subtitle = request.POST.get("subtitle", "")
            blog = request.POST.get("blog", "")

            if len(title) == 0 or len(title) > 200:
                isError = True
                titleError = True

            if len(subtitle) > 200:
                isError = True
                subtitleError = True

            if len(blog) == 0 or len(blog) < 10:
                isError = True
                blogError = True

            if isError:
                return render(request, 'bel/blogadd.html', {'auth': auth, 'username': username, 'titleError': titleError, 'subtitleError': subtitleError, 'blogError': blogError, 'title': title, 'subtitle': subtitle, 'blog': blog})
            else:
                try:
                    username = request.session['bel_username']
                    blogger = Blogger.objects.get(username=username)
                    blog = Blog(title=title, subtitle=subtitle,
                                blog=blog, blogger=blogger)
                    blog.save()
                    return redirect("blog", pk=blog.id)
                except IntegrityError:
                    error = "Blog already exist with same title"
                    return render(request, 'bel/blogadd.html', {'auth': auth,'username': username,'error':error,'title': title, 'subtitle': subtitle, 'blog': blog})
        else:
            return render(request, 'bel/blogadd.html', {'auth': auth, 'username': username})
    else:
        return redirect("blogger-login")


def blogedit(request, pk):
    if 'bel_username' in request.session:
        auth = True
        username = request.session['bel_username']
        blog = Blog.objects.get(pk=pk)
        if blog.blogger.username != username:
            return redirect("blog-home")

        if request.method == 'POST':
            change = False
            error = ""
            updated_title = request.POST.get("title", "")
            updated_subtitle = request.POST.get("subtitle", "")
            updated_blog = request.POST.get("blog", "")
            previous_blog = blog

            if updated_title != previous_blog.title:
                previous_blog.title = updated_title
                change = True
            if updated_subtitle != previous_blog.subtitle:
                previous_blog.subtitle = updated_subtitle
                change = True
            if updated_blog != previous_blog.blog:
                previous_blog.blog = updated_blog
                change = True

            if change:
                blog.save()
                return redirect("blog", pk=blog.id)
            else:
                error = "Previous blog and this blog is same."
                return render(request, 'bel/blogedit.html', {'auth': auth, 'username': username, 'error': error,'blog': blog})
        else:
            return render(request, 'bel/blogedit.html', {'auth': auth, 'username': username, 'blog': blog})

    else:
        return redirect("blogger-login")


def blogdelete(request, pk):
    if 'bel_username' in request.session:
        auth = True
        username = request.session['bel_username']
        blog = Blog.objects.get(pk=pk)
        if blog.blogger.username != username:
            return redirect("blog-home")

        if request.method == 'POST':
            if request.POST.get("yes"):
                blog.delete()
                return redirect("blog-home")
            else:
                return redirect("blog", pk=blog.id)
        else:
            return render(request, 'bel/blogdelete.html', {'auth': auth, 'username': username, 'blog': blog})

    else:
        return redirect("blogger-login")


def blogcommentadd(request, blog):
    if 'bel_username' in request.session:
        auth = True
        username = request.session['bel_username']
        blog = Blog.objects.get(pk=blog)
        
        if blog.blogger.username == username:
            return redirect("blog", pk=blog.id)
        
        if request.method == 'POST':
            blogger = Blogger.objects.filter(username=username).first()
            commenthtml = request.POST.get("comment")

            if len(commenthtml) == 0 or len(commenthtml) > 300 :
                error = "Comment Can't be empty and max 300 character longer."
                return render(request, 'bel/blogcommentadd.html', {'auth': auth, 'username': username,'error':error, 'blog': blog})

            comment = Comment(comment=commenthtml, blog=blog, blogger=blogger)
            comment.save()
            return redirect("blog", pk=blog.id)
        else:
            return render(request, 'bel/blogcommentadd.html', {'auth': auth, 'username': username, 'blog': blog})
    else:
        return redirect("blogger-login")


def blogcommentresponse(request, blog, comment):
    if 'bel_username' in request.session:
        auth = True
        username = request.session['bel_username']
        blog = Blog.objects.get(pk=blog)
        comment = Comment.objects.get(pk=comment)
        if blog.blogger.username == username:
            if request.method == 'POST':
                blogger = Blogger.objects.filter(username=username).first()
                commenthtml = request.POST.get("comment")

                if len(commenthtml) == 0 or len(commenthtml) > 300 :
                    error = "Comment Can't be empty and max 300 character longer."
                    return render(request, 'bel/blogcommentadd.html', {'auth': auth, 'username': username,'error':error,'blog': blog, })

                responseComment = Comment(comment=commenthtml, blog=blog, blogger=blogger, isResponce=True)
                responseComment.save()
                comment.responseComment = responseComment
                comment.save()
                return redirect("blog", pk=blog.id)
            else:
                return render(request, 'bel/blogcommentadd.html', {'auth': auth, 'username': username, 'blog': blog, })
        else:
            return redirect("blog", pk=blog.id)
    else:
        return redirect("blogger-login")


def profile(request):
    if 'bel_username' in request.session:
        auth = True
        username = request.session['bel_username']
        blogger = Blogger.objects.filter(username=username).first()
        blogs = blogger.blog_set.all()
        return render(request, 'bel/profile.html', {"blogger": blogger, 'blogs': blogs, 'auth': auth, 'username': username})
    else:
        return redirect("blogger-login")
