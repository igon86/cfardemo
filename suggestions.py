import random
import operator

with open("movies.txt") as f:
    movie_list = f.read()
with open("output_predictions.txt") as g:
    prediction_list = g.read()

l = zip(movie_list.split("\n"), prediction_list.split("\n"))
random.shuffle(l)
l.sort(key=operator.itemgetter(1))
print l
