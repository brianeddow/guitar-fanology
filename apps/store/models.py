from django.db import models
from datetime import datetime

class ProductManager(models.Manager):
	def active(self):
		return self.get_query_set().filter(is_active=True)
	def featured(self):
		return self.get_query_set().filter(is_featured=True)

	# Product.objects.active()
	# Product.objects.featured()

class ProductQueryset(models.query.QuerySet):
	def active(self):
		return self.filter(is_active=True)
	def featured(self):
		return self.filter(is_featured=True)

	#Product.objects.active().featured()

class Product(models.Model):
	name = models.CharField(max_length=60)
	description = models.TextField()
	created_at = models.DateTimeField('Created At', auto_now_add=True, auto_now=False, null=False)

	def __str__(self):
		return self.name

	class Meta:
		db_table = 'products'

class Guitar(models.Model):
	strings = (
		('6', '6 Strings'),
		('7', '7 Strings'),
		('8', '8 Strings')
	)

	name = models.CharField(max_length=30,default='Guitar')
	num_strings = models.CharField(max_length=1,choices=strings)
	pickup_type = models.CharField(max_length=30,default='Humbucker')
	locking_nut = models.BooleanField(default=False)
	hollow_body = models.BooleanField(default=False)
	jumbo_frets = models.BooleanField(default=True)
	custom_tuner_keys = models.BooleanField(default=False)

	def __str__(self):
		return self.name

	class Meta:
		db_table = 'guitars'
