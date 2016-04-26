from django.db import models
from datetime import datetime
from django.contrib.auth.models import User

class Lesson(models.Model):
	name = models.CharField(max_length=100,null=False)
	lesson_content = models.TextField(null=False,default='')
	created_at = models.DateTimeField(auto_now_add=True,auto_now=False)

	def __str__(self):
		return self.name

	class Meta:
		db_table = 'lessons'

class Like(models.Model):
	member = models.ForeignKey(User)
	lesson = models.ForeignKey(Lesson)

	def __str__(self):
		return 'likes'

	class Meta:
		db_table = 'likes'
