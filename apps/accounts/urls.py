from django.conf.urls import patterns, url
from django.contrib.auth.decorators import login_required
from . import views

urlpatterns = patterns('',
	url(r'^$', views.index, name='accounts_index'),
	url(r'^login/', views.Login.as_view(), name='accounts_login'),
	url(r'^register/', views.Register.as_view(), name='accounts_register'),
	url(r'^logout/$', views.Logout.as_view(), name='accounts_logout'),
	url(r'^success/$', login_required(views.Success.as_view(), login_url='accounts_login'), name='accounts_success'),
	url(r'^like/(?P<lesson_id>\d+)/$', views.LikeLesson.as_view(), name='like_lesson'),
	url(r'^lessons/(?P<lesson_id>\d+)/$', views.Lessons.as_view(), name='lessons'),
	url(r'^manage_lessons/$', views.ManageLessons.as_view(), name='manage_lessons'),
	url(r'^add_lesson/$', views.AddLesson.as_view(), name='add_lesson'),
	url(r'^edit_lesson/(?P<lesson_id>\d+)/$', views.EditLesson.as_view(), name='edit_lesson'),
	url(r'^update_lesson/(?P<lesson_id>\d+)/$', views.UpdateLesson.as_view(), name='update_lesson'),
	url(r'^remove_lesson/(?P<lesson_id>\d+)/$', views.RemoveLesson.as_view(), name='remove_lesson')
)