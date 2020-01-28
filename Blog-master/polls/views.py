from django.shortcuts import render
from django.db import IntegrityError
from django.shortcuts import redirect
from .models import Admin,User,Poll,Choice,Category,Vote
from datetime import datetime, timedelta 
from django.utils import timezone
import random

def loginAdmin(request):
    if 'polls_username_L'  in request.session:
        return redirect("polls-admin-home")
    else:
        if request.method == 'POST':
            username = request.POST.get("username", "")
            password = request.POST.get("password", "")
            
            if len(username)==0 or len(username)>30 or len(password)==0 or len(password)>30:
                error="Can't be empty and max 30 character longer."
                return render(request, 'polls/admin-login.html', {"error" : error})

            admin = Admin.objects.filter(username=username,password=password).first()

            if admin:
                request.session['polls_username_L'] = username
                return redirect("polls-admin-home")
            else:
                error="Invalid username"
                return render(request, 'polls/admin-login.html', {"error" : error})
        else:
            return render(request,'polls/admin-login.html')


def logoutAdmin(request):
    if 'polls_username_L'  in request.session:
        del request.session['polls_username_L']
    return redirect("polls-home")


def indexAdmin(request):
    if 'polls_username_L'  in request.session:
        username = request.session['polls_username_L'] 
        auth=True
    else:
        auth=False
        username=""

    categories = Category.objects.all()
    return render(request,'polls/admin-index.html',{'auth':auth,'username':username,'categories':categories})


def addCategoryAdmin(request):
    if 'polls_username_L'  in request.session:
        auth=True
        username=request.session['polls_username_L']

        if request.method == 'POST':
            category = request.POST.get("category", "")

            if len(category)==0 or len(category)>30 :
                error="Can't be empty and max 30 character longer."
                return render(request, 'polls/admin-add-category.html', {"error" : error,'auth':auth,'username':username})
            
            try:
                category = Category(category=category)
                category.save()
                return redirect("polls-admin-home")
            except IntegrityError:
                error="Category already exist"
                return render(request,'polls/admin-add-category.html',{'auth':auth,'username':username,'error':error})
        else:
            return render(request,'polls/admin-add-category.html',{'auth':auth,'username':username})
    else:
        return redirect("polls-login-admin")



def index(request):
    if 'polls_username'  in request.session:
        username = request.session['polls_username'] 
        auth=True
    else:
        username=""
        auth=False

    polls = sorted(Poll.objects.filter(expires_at__gte=timezone.now(),expires_at__lte=timezone.now() + timedelta(days=1)), key=lambda x: random.random())
    return render(request,'polls/index.html',{'auth':auth,'username':username,'polls':polls})


def register(request):
    if 'polls_username'  in request.session:
        return redirect("polls-home")
    else:
        if request.method == 'POST':
            username = request.POST.get("username", "")
            password = request.POST.get("password", "")

            if len(username)==0 or len(username)>30 or len(password)==0 or len(password)>30:
                error="Can't be empty and max 30 character longer."
                return render(request, 'polls/register.html', {"error" : error})

            try:
                user = User(username=username,password=password)
                user.save()
                request.session['polls_username'] = username
                return redirect("polls-home")
            except IntegrityError:
                error="User already exist with same username"
                return render(request, 'polls/register.html', {"error" : error})
        else:
            return render(request,'polls/register.html')


def login(request):
    if 'polls_username'  in request.session:
        return redirect("polls-home")
    else:
        if request.method == 'POST':
            username = request.POST.get("username", "")
            password = request.POST.get("password", "")
            
            if len(username)==0 or len(username)>30 or len(password)==0 or len(password)>30:
                error="Username and password can't be empty and max 30 character longer."
                return render(request, 'polls/login.html', {"error" : error})

            user = User.objects.filter(username=username,password=password).first()

            if user:
                request.session['polls_username'] = username
                return redirect("polls-home")
            else:
                error="Invalid username or password"
                return render(request, 'polls/login.html', {"error" : error})
        else:
            return render(request,'polls/login.html')

def logout(request):
    if 'polls_username'  in request.session:
        del request.session['polls_username']
    return redirect("polls-home")

def addpoll(request):
    if 'polls_username'  in request.session:
        auth=True
        username=request.session['polls_username']
        categories= Category.objects.all()
        expire = datetime.now() + timedelta(days=1)
        expire= expire.strftime("20%y-%m-%dT%H:%M")

        if request.method == 'POST':
            poll = request.POST.get("poll", "")
            categoryhtml = request.POST.get("category", "")
            totalchoicenumber = request.POST.get("totalchoicenumber", "0")
            expire_at = request.POST.get("expire", "")

            def RepresentsInt(s):
                try: 
                    int(s)
                    return True
                except ValueError:
                    return False
            
            if len(poll)<4 or len(poll)>200:
                error="poll should be min 4 and max 200 character longer."
                return render(request, 'polls/add-polls.html', {'auth':auth,'username':username,"error" : error,'categories':categories,'expire':expire})

            category = Category.objects.filter(category__contains=categoryhtml).first()
            if not category:
                error="Category not found.Select correct one from search suggestion."
                return render(request, 'polls/add-polls.html', {'auth':auth,'username':username,"error" : error,'categories':categories,'expire':expire})

            if RepresentsInt(totalchoicenumber):
                if int(totalchoicenumber) < 2 or int(totalchoicenumber) > 6:
                    error="Max 6 Min 2 Choices allow"
                    return render(request, 'polls/add-polls.html', {'auth':auth,'username':username,"error" : error,'categories':categories,'expire':expire})
            else:
                error="Max 6 Min 2 Choices allow"
                return render(request, 'polls/add-polls.html', {'auth':auth,'username':username,"error" : error,'categories':categories,'expire':expire})

            expire_at = datetime.strptime(expire_at, '20%y-%m-%dT%H:%M')
            if expire_at > datetime.now() + timedelta(days=1) or expire_at < datetime.now() + timedelta(hours=6):
                error = "Expire date can be max 24H and min 6H  after poll created"
                return render(request, 'polls/add-polls.html', {'auth':auth,'username':username,"error" : error,'categories':categories,'expire':expire})

            choicelist=[]
            for i in range(1,int(totalchoicenumber)+1):
                choiceItem = request.POST.get("choice%s" % str(i), "")
                if len(choiceItem)==0 or len(choiceItem)>50:
                    error="Choice Can't be empty and max 50 character longer."
                    return render(request, 'polls/add-polls.html', {'auth':auth,'username':username,"error" : error,'categories':categories,'expire':expire})
                choicelist.append(choiceItem)
            
            user = User.objects.filter(username=username).first()

            poll = Poll(poll=poll,owner=user,category=category,expires_at=expire_at)
            poll.save()
            for choiceItem in choicelist:
                choice=Choice(choice=choiceItem,poll=poll)
                choice.save()
            
            return redirect("polls-home")
       
        else:
            return render(request, 'polls/add-polls.html', {'auth':auth,'username':username,'categories':categories,'expire':expire})
    
    else:
        return redirect("polls-login")


def pollvote(request,pk):

    poll = Poll.objects.get(pk=pk)
    choices = poll.choice_set.all()
    expire = poll.expires_at
    if expire < timezone.now():
        if 'polls_username'  in request.session:
            return redirect("poll-result",pk=pk)

    if 'polls_username'  in request.session:
        auth=True
        username=request.session['polls_username']
        user = User.objects.filter(username=username).first()
        vote = Vote.objects.filter(user=user,poll=poll).first()
        if vote:
            return redirect("poll-result",pk=pk)

        if request.method == 'POST':
            voteChoicehtml = request.POST.get("voteChoice", "")
            if voteChoicehtml:
                voteChoice = Choice.objects.filter(choice=voteChoicehtml,poll=poll).first()
                if voteChoice:
                    voteChoice.vote+=1
                    voteChoice.save()
                    vote = Vote(user=user,poll=poll)
                    vote.save()
                    return redirect("poll-result",pk=poll.pk)
                else:
                    error="Some error occured"
                    return render(request, 'polls/poll.html', {'auth':auth,'username':username,"error" : error,'poll':poll,'choices':choices})
            else:
                error="You must choose choice from given list"
                return render(request, 'polls/poll.html', {'auth':auth,'username':username,"error" : error,'poll':poll,'choices':choices})
        else:
            return render(request, 'polls/poll.html', {'auth':auth,'username':username,"error" : error,'poll':poll,'choices':choices})
    else:
        return redirect("poll-result",pk=pk)

def pollresult(request,pk):
    auth=False
    username=""
    poll = Poll.objects.get(pk=pk)
    choices = poll.choice_set.all().order_by('-vote')
    totalVote=0

    for c in choices:
        totalVote+=c.vote
    progresslist = []
    for c in choices:
        val = c.vote*100/totalVote
        val="{0:.2f}".format(val)
        progresslist.append(val)
    choicesprogress=zip(choices,progresslist)

    if 'polls_username'  in request.session:
        auth=True
        username=request.session['polls_username']
    return render(request, 'polls/result-poll.html', {'auth':auth,'username':username,'poll':poll,'choicesprogress':choicesprogress})

def profile(request):
    if 'polls_username'  in request.session:
        auth=True
        username=request.session['polls_username']
        user = User.objects.filter(username=username).first()
        polls = user.poll_set.all()
        return render(request, 'polls/profile.html', {'auth':auth,'username':username,"user" : user,'polls':polls})
    else:
        return redirect("polls-login")



