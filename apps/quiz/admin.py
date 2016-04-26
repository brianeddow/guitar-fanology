from django.contrib import admin

# Register your models here.
from .models import Question
from .models import Choice

class QuestionAdmin(admin.ModelAdmin):
	list_display = ["__unicode__", "pub_date"]

	class Meta:
		model = Question

class ChoiceAdmin(admin.ModelAdmin):
	list_display = ["__unicode__", "question"]

	class Meta:
		model = Choice

admin.site.register(Question)
admin.site.register(Choice)