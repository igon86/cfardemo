#!/usr/bin/python

import sys
import os

training_file = 'current_training.txt'
try:
    fout = open(training_file, 'w')
    for num,fname in enumerate(sys.argv[1:]):

        print fname
        with open(fname) as f:
            content = f.readlines()

        for rating in content:
            rating = rating.replace("\n", "")
            tokens = rating.split(",")
            fout.write(str(num)+","+tokens[1]+","+tokens[2]+","+tokens[3] + "\n")

except (OSError, IOError) as e:
    print "error opening current_training ",e
    raise

with open(training_file) as f:
    num_ratings = len(f.readlines())
    print "This many ratings: ",num_ratings

with open("movies.txt") as f:
    num_movies = len(f.readlines())
    print "This many movies: ",num_movies

num_users = len(sys.argv) - 1
print "This many users: ",num_users

num_iterations = 20

output_model           = 'current_edge_model.txt'
output_model_movielens = 'edges_movielens100k.txt'

prediction_file = sys.argv[-1]

#<num_movies> <num_users> <num_iterations> <training_file> <ratings> <output_model>
try:
    f = open('parameters.train', 'w')
    f.write(training_file + " " + str(num_users) + " " + str(num_movies) + " " + str(num_iterations) + " " + str(num_ratings))
except (OSError, IOError) as e:
    print "error opening parameters.train: ",e
    raise



try:
    f = open('parameters.predict', 'w')
    f.write(str(num_movies) + " " + output_model + " " + prediction_file)
except (OSError, IOError) as e:
    print "error opening parameters.predict: ",e
    raise



try:
    f = open('parameters.predict.movielens', 'w')
    f.write(str(num_movies) + " " + output_model_movielens + " " + prediction_file)
except (OSError, IOError) as e:
    print "error opening parameters.predict: ",e
    raise


