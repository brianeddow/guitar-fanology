from django import forms

class ContactForm(forms.Form):
	full_name = forms.CharField(label='Full name', max_length=100)
	email = forms.CharField(label='Email', max_length=100)