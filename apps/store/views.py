from django.http import HttpResponse, Http404, HttpResponseNotFound
from django.shortcuts import render, redirect
from datetime import datetime
from .models import Product
from .forms import ContactForm

def index(request):
	return render(request, 'store/index.html')

def contact_form(request):
	form = ContactForm(request.POST or None)
	if form.is_valid():
		print form.cleaned_data['full_name']
		print form.cleaned_data['email']
	
	context = {
		'form': form
	}
	template = 'store/contact.html'
	return render(request, template, context)

def submit_contact_form(request):
	name = request.POST.get('full_name')
	email = request.POST.get('email')
	context = {
		'name': name,
		'email': email
	}
	return render(request, 'store/contact_submitted.html', context)

def products(request):
	products = Product.objects.all()

	context = {
		'products': products,
	}
	return render(request, 'store/product.html', context)

def new_product(request):
	return render(request, 'store/add_product.html')

def add_product(request):
	prod_name = request.POST.get('name', '')
	prod_description = request.POST.get('desc', '')
	product = Product.objects.create(name=prod_name, description=prod_description, created_at=datetime.now())
	context = {
		'product': product
	}
	return render(request, 'store/product_added.html', context)

def show(request, question_id):
	if int(question_id) == 1:
		return HttpResponseNotFound('<h1>404 Not Found!</h1>')
	else:
		return HttpResponse("The question number you are looking for is <h1>%s</h1>" % question_id)

def show_more(request):
	context = {
		'guitars': [
			{'name': 'Gibson', 'model': 'Les Paul', 'url': 'store/gibsonlespaul.jpg'},
			{'name': 'ESP', 'model': 'Eclipse', 'url': 'store/especlipse.jpg'},
			{'name': 'Fender', 'model': 'Stratocaster', 'url': 'store/fenderstrat.jpg'},
			{'name': 'Epiphone', 'model': 'Les Paul', 'url': 'store/epiphone'},
			{'name': 'Ovation', 'model': 'Elite', 'url': 'store/ovationelite.png'}
		]
	}

	return render(request, 'store/show.html', context)