from django.db import models
from datetime import datetime

class Question(models.Model):
	question_text = models.TextField(max_length=200, null=False)
	pub_date = models.DateTimeField('date published', auto_now_add=True, auto_now=False, null=False)

	class Meta:
		db_table = 'questions'

	def __str__(self):
		return self.question_text

class Choice(models.Model):
	question = models.ForeignKey(Question, null=False)
	choice_text = models.TextField(max_length=200, null=False)

	class Meta:
		db_table = 'choices'

	def __str__(self):
		return self.choice_text