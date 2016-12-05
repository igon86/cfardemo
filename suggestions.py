import random
import operator

with open("movies.txt") as f:
    movie_list = f.read()
with open("output_predictions.txt") as g:
    prediction_list = g.read()

movies = [ x for x in movie_list.split("\n") if len(x) > 0 ]
movies = [ x.split("|")[1] for x in movies ]
l = zip(movies, prediction_list.split("\n"))
random.shuffle(l)
l.sort(key=operator.itemgetter(1))
print "\n".join( [str(x[0])+","+str(x[1]) for x in l[:10] ] )
