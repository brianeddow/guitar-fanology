from django import forms

class ReviewForm(forms.Form):
	RATING = (
		(10, 10),
		(9, 9),
		(8, 8),
		(7, 7),
		(6, 6),
		(5, 5),
		(4, 4),
		(3, 3),
		(2, 2),
		(1, 1)
		)
	name = forms.CharField(label='Name', max_length=50)
	review = forms.CharField(label='Email', widget=forms.Textarea)
	rating = forms.ChoiceField(label='Rating',choices=RATING)
	suggestions = forms.CharField(label='Suggestions', widget=forms.Textarea)
