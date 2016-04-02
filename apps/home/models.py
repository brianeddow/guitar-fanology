from django.db import models
from datetime import datetime

class Review(models.Model):
	name = models.CharField(max_length=100, null=False)
	review = models.CharField(max_length=500, null=False)
	rating = models.IntegerField(null=False)
	suggestions = models.TextField(null=False)
	created_at = models.DateTimeField('Created At', default=datetime.now())

	def __str__(self):
		return self.name

	class Meta:
		db_table = 'reviews'

class Notes(models.Model):
	name = models.CharField(max_length=10)
	scale = models.CharField(max_length=10)
	notes = models.TextField(null=False)

	def __str__(self):
		return self.name

	class Meta:
		db_table = 'notes'