from django.http import HttpResponse, Http404, HttpResponseNotFound
from django.shortcuts import render, redirect
from datetime import datetime
from .models import Question, Choice

def index(request):
	# return render(request, 'quiz/index.html')

	context = {
		'questions': [
		{ 'id': 1, 'content': 'Why is there a light in the fridge and not in the freezer?'},
		{ 'id': 2, 'content': 'Why don\'t sheep shrink when it rains?'},
		{ 'id': 3, 'content': 'Why are they called apartments when they are all together?'},
		{ 'id': 4, 'content': 'Why are cigarettes sold where smoking is prohibited?'},
			]
		}

	return render(request, 'quiz/index.html', context)
 

def show(request, question_id):
	# return HttpResponse("You are looking at question number %s." % question_id)

	# if int(question_id) == 1:
	# 	return HttpResponse('<h1>Page found!</h1>')
	# else:
	# 	raise Http404

	# if int(question_id) == 1:
	# 	return HttpResponse('<h1> Page found! </h1>')
	# else:
	# 	return HttpResponseNotFound('<h1> Page not found! </h1>')

	req_question = Question.objects.get(id=question_id)

	choices = Choice.objects.all().filter(question=req_question)

	context = {
		'question': req_question,
		'choices': choices
	}

	return render(request, 'quiz/show.html', context)

def question(request):
	return render(request, 'quiz/add_question.html')

def choice(request, question_id):
	question = Question.objects.get(id=question_id)
	context = {
		'question': question
	}
	return render(request, 'quiz/add_choice.html', context)

def show_questions(request):
	questions = Question.objects.all()
	choices = Choice.objects.all()

	context = {
		'questions': questions,
		'choices': choices
	}
	return render(request, 'quiz/show_questions.html', context)

def add_question(request):
	question_text = request.POST.get("question_text")
	Question.objects.create(question_text=question_text,pub_date=datetime.now())
	return redirect('show_questions')

def add_choice(request, question_id):
	question = Question.objects.get(id=question_id)
	choice_text = request.POST.get("choice_text")
	choice = Choice.objects.create(question=question,choice_text=choice_text)
	context = {
		'choice': choice
	}
	return render(request, 'quiz/choice_added.html', context)