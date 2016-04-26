from django.http import HttpResponse, Http404, HttpResponseNotFound
from django.shortcuts import render, redirect
from .forms import ReviewForm
from django.utils import timezone
from .models import Review
from django.views.generic import View

def index(request):
	# return HttpResponse("You are looking at question number %s." % question_id)

	# if int(question_id) == 1:
	# 	return HttpResponse('<h1>Page found!</h1>')
	# else:
	# 	raise Http404

	# if int(question_id) == 1:
	# 	return HttpResponse('<h1> Page found! </h1>')
	# else:
	# 	return HttpResponseNotFound('<h1> Page not found! </h1>')

	context = {
		'assertions': [
		{ 'id': 1, 'content': 'First Django Landing Page!!'},
		{ 'id': 2, 'content': 'And it\'s baller'},
		{ 'id': 3, 'content': 'Django is fun!'},
		{ 'id': 4, 'content': 'Django'},
			]
		}

	return render(request, 'home/index.html', context)

def show(request, chord_id):

	chords = {}

	A = {
		'name': 'A Major',
		'scale': 'Major scale',
		'notes': ['A','B','C#','D','E','F#','G#','A']
	}
	Am = {
		'name': 'A Minor',
		'scale': 'Minor scale',
		'notes': ['A','B','C','D','E','F','G','A']
	}
	B = {
		'name': 'B Major',
		'scale': 'Major scale',
		'notes': ['B','C#','D#','E','F#','G#','A#','B']
	}
	Bm = {
		'name': 'B Minor',
		'scale': 'Minor scale',
		'notes': ['B','C#','D','E','F#','G','A','B']
	}
	C = {
		'name': 'C Major',
		'scale': 'Major scale',
		'notes': ['C','D','E','F','G','A','B','C']
	}
	Cm = {
		'name': 'C Minor',
		'scale': 'Minor scale',
		'notes': ['C','D','Eb','F','G','Ab','Bb','C']
	}
	D = {
		'name': 'D Major',
		'scale': 'Major scale',
		'notes': ['D','E','F#','G','A','B','C#','D']
	}
	Dm = {
		'name': 'D Minor',
		'scale': 'Minor scale',
		'notes': ['D','E','F','G','A','Bb','C','D']
	}
	E = {
		'name': 'E Major',
		'scale': 'Major scale',
		'notes': ['E','F#','G#','A','B','C#','D#','E']
	}
	Em = {
		'name': 'E Minor',
		'scale': 'Minor scale',
		'notes': ['E','F#','G','A','B','C','D','E']
	}
	F = {
		'name': 'F Major',
		'scale': 'Major scale',
		'notes': ['F','G','A','Bb','C','D','E','F']
	}
	Fm = {
		'name': 'F Minor',
		'scale': 'Minor scale',
		'notes': ['F','G','Ab','Bb','C','Db','Eb','F']
	}
	E = {
		'name': 'E Major',
		'scale': 'Major scale',
		'notes': ['E','F#','G#','A','B','C#','D#','E']
	}
	Em = {
		'name': 'E Minor',
		'scale': 'Minor scale',
		'notes': ['E','F#','G','A','B','C','D','E']
	}
	F = {
		'name': 'F Major',
		'scale': 'Major scale',
		'notes': ['F','G','A','Bb','C','D','E','F']
	}
	Fm = {
		'name': 'F Minor',
		'scale': 'Minor scale',
		'notes': ['F','G','Ab','Bb','C','Db','Eb','F']
	}
	G = {
		'name': 'G Major',
		'scale': 'Major scale',
		'notes': ['G','A','B','C','D','E','F#','G']
	}
	Gm = {
		'name': 'G Minor',
		'scale': 'Minor scale',
		'notes': ['G','A','Bb','C','E','Eb','F','G']
	}

	chords = {
		'A': A,
		'Am': Am,
		'B': B,
		'Bm': Bm,
		'C': C,
		'Cm': Cm,
		'D': D,
		'Dm': Dm,
		'E': E,
		'Em': Em,
		'F': F,
		'Fm': Fm,
		'G': G,
		'Gm': Gm,
	}

	chord = chords[chord_id]

	context = {
		'chord': chord,
	}

	return render(request, 'home/show.html', context)

def chords(request):
	return render(request, 'home/chords.html')

def review_us(request):
	form = ReviewForm(request.POST or None)
	context = {
		'form': form
	}
	return render(request, 'home/review.html', context)

class SubmitReview(View):
	form = ReviewForm
	template = 'home/review.html'

	def get(self, request):
		context = {'form' : self.form()}
		return render(request, self.template, context)

	def post(self, request):
		form = self.form(request.POST)

		if form.is_valid():
			print form.cleaned_data
			name = form.cleaned_data['name']
			review = form.cleaned_data['review']
			rating = form.cleaned_data['rating']
			suggestions = form.cleaned_data['suggestions']

			Review.objects.create(name=name,review=review,rating=rating,suggestions=suggestions)

			return redirect('/reviews/')
		else:
			context = {'form': form}
			return render(request, 'home/review.html', context)

def reviews(request):
	reviews = Review.objects.all().order_by('-created_at')
	context = {
		'reviews': reviews
	}
	return render(request, 'home/reviews.html', context)

def discovery(request):
	return render(request, 'home/discovery.html')
