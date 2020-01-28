from django.test import TestCase
from django.urls import reverse
from .models import Blog

# Create your tests here.
def create_blog(title,subtitle,blog,user):
    """
    Create a question with the given `question_text` and published the
    given number of `days` offset to now (negative for questions published
    in the past, positive for questions that have yet to be published).
    """
    return Blog.objects.create(title=title,subtitle=subtitle,blog=blog,blogger=user)

class BlogIndexViewTests(TestCase):
    def test_no_blogs(self):
        response = self.client.get(reverse('blog-home'))
        self.assertEqual(response.status_code, 200)
        self.assertContains(response, "No polls are available.")
        self.assertQuerysetEqual(response.context['blogs'], [])