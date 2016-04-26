from django.http import HttpResponse, Http404, HttpResponseNotFound, HttpResponseRedirect
from django.shortcuts import render, redirect
from django.utils import timezone
from django.contrib.auth import login, logout, authenticate, forms
from django.views.generic import View
from .forms import LoginForm, RegisterForm
from django.contrib.auth.models import User
from .models import Lesson, Like

def index(request):
	if not request.user.is_authenticated():
		form_reg = RegisterForm
		form_log = LoginForm
		context = {
			'form_reg': form_reg,
			'form_login': form_log
		}
		return render(request, 'accounts/index.html', context)
	else:
		return redirect('/accounts/success/')

class Register(View):
	form = RegisterForm
	template = 'accounts/register.html'

	def get(self, request):
		context = {'form' : self.form()}
		return render(request, self.template, context)

	def post(self, request):
		form = self.form(request.POST)

		if form.is_valid():
			print form.cleaned_data
			username = form.cleaned_data['username']
			first_name = form.cleaned_data['first_name']
			last_name = form.cleaned_data['last_name']
			email = form.cleaned_data['email']
			password = form.cleaned_data['password2']

			User.objects.create(username=username,first_name=first_name,last_name=last_name,email=email,password=password)

			form.save()
			return redirect('/accounts/success')
		else:
			context = {'form': form}
			return render(request, 'accounts/register.html', context)

class Login(View):
	form = LoginForm

	def get(self, request):
		print self.form
		context = {
			'form': self.form()
		}
		return render(request, 'accounts/login.html', context)

	def post(self, request):
		form = self.form(None, request.POST)
		context = {'form' : form}

		if form.is_valid():
			username = form.cleaned_data['username']
			password = form.cleaned_data['password']
			user = authenticate(username=username, password=password)
			if user is not None:
				login(request, user)
				return redirect('/accounts/success/')
			else:
				return render(request, 'accounts/login.html', context)
		else:
			return render(request, 'accounts/login.html', context)

class Success(View):

	def get(self, request):
		if request.user.is_authenticated():
			user = User.objects.get(id=request.user.id)
			lessons = Lesson.objects.all()
			likes = Like.objects.filter(member_id=request.user.id)

			ids = []
			for like in likes:
				ids.append(like.lesson_id)

			lesson_names = []
			for id in ids:
				lesson_names.append(Lesson.objects.get(id=id))

			context = {
				'user': user,
				'id': request.user.id,
				'lessons': lessons,
				'likes': lesson_names
			}
			return render(request, 'accounts/success.html', context)
		else:
			return redirect('/accounts/login/')

	def post(self, request):
		return render(request, 'accounts/success.html')

class Logout(View):
	def get(self, request):
		logout(request)
		return redirect('/accounts/')

class Lessons(View):
	def get(self, request, lesson_id):
		x = Lesson.objects.get(id=lesson_id)
		context = {
			'lesson': x
		}
		return render(request, 'accounts/lesson.html', context)

class AddLesson(View):
	def get(self, request):
		return render(request, 'accounts/add_lesson.html')

	def post(self, request):
		# return HttpResponse("info: "+str(request.POST.get('lesson_content')))
		name = request.POST.get('name')
		lesson = request.POST.get('lesson_content')
		new = Lesson.objects.create(name=name,lesson_content=lesson,created_at=timezone.now())
		context = {
			'lesson': new
		}
		return render(request, 'accounts/new_lesson.html', context)

class RemoveLesson(View):
	def get(self, request, lesson_id):
		# return HttpResponse("id: "+str(lesson_id))
		L = Lesson.objects.get(id=lesson_id)
		L.delete()
		return redirect('/accounts/manage_lessons/')

class ManageLessons(View):
	def get(self, request):
		lessons = Lesson.objects.all()
		context = {
			'lessons': lessons
		}
		return render(request, 'accounts/manage_lessons.html', context)

class EditLesson(View):
	def get(self, request, lesson_id):
		lesson = Lesson.objects.get(id=lesson_id)
		context = {
			'lesson': lesson
		}
		return render(request, 'accounts/edit_lesson.html', context)

class UpdateLesson(View):
	def post(self, request, lesson_id):
		name = request.POST.get('name')
		content = request.POST.get('lesson_content')
		lesson = Lesson.objects.get(id=lesson_id)
		lesson.name = name
		lesson.lesson_content = content
		lesson.save()
		return redirect('/accounts/manage_lessons/')


class LikeLesson(View):
	def get(self, request, lesson_id):
		# return HttpResponse('lesson id: '+str(lesson_id)+", user id: "+str(request.user.id))
		L = Like.objects.create(member_id=request.user.id, lesson_id=lesson_id)
		context = {
			'likes': L
		}
		# return render(request, 'accounts/like_success.html', context)
		return redirect('/accounts/lessons/'+lesson_id+'/')
