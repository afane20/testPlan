/**********************************************************************
 * Program:
 *    Assignment 01, Set Class
 *    Brother Ercanbrack, CS 235
 * Author:
 *    Adam Nickle
 * Summary:
 *    Demonstrates the basics of class creation, memory management, and
 *    class testing with the goal of creating a number set class.
 ***********************************************************************/

/***********************************************************************
*This first assignment is a simple class that demonstrates object-oriented
*programming, including member functions, friend functions, private data,
*dynamic allocation of memory, etc.  This assignment took about three hours
*to complete.  As tested on my own computer, this code works flawlessly and
*matches the output files perfectly when provided with the corresponding
*input files.
***********************************************************************/

#include <iostream>
#include <cassert>
#include <fstream>
#include <string.h>
using namespace std;

//Define global constants
const int LIMIT_DEFAULT = 10;

/********************************************************************
* CLASS: Set Definition
*    Definition for the Set class
********************************************************************/
class Set
{
   public:
      Set(); //default constructor
      Set(const Set &cpy); //copy constructor
      ~Set();

      //get functions
      int getSize();
      bool checkValue(int element) const;

      //pseudo-setters
      bool add(int num);

      //setters
      bool setLimit(const int limit);

      //overloaded operators
      const Set& operator = (const Set &rhs); //assignment
      //assignment returns by reference because it modifies a variable
      //instead of creating a new variable

      const Set  operator - (const Set &rhs) const; //difference operator
      const Set  operator || (const Set &rhs) const; //union operator
      const Set  operator && (const Set &rhs) const; //intersection operator
      const bool operator == (const Set &rhs) const; //traditional comparison
      friend ostream& operator << (ostream &out, const Set &rhs);

   private:
      int* list;
      int size;
      int limit;
};

/********************************************************************
* CLASS: Set
*    Default Constructor
********************************************************************/
Set::Set()
{
   list = new int[LIMIT_DEFAULT];
   limit = LIMIT_DEFAULT;
   size = 0;
}

/********************************************************************
* CLASS: Set
*    Copy Constructor
********************************************************************/
Set::Set(const Set &src)
{
   limit = src.limit;
   size = src.size;

   //create the array
   list = new int[src.limit];

   //copy the array from the input object
   assert(src.size <= src.limit); //DEBUG
   for (int i = 0; i < src.size; i++) //loop through both arrays and copy
   {
      list[i] = src.list[i];
   }

   //DEBUG
   assert(limit == src.limit);
   assert(size  == src.size);
}

/********************************************************************
 * CLASS: Set
 *    This function simply returns the value of the member variable
 *    "size"
 *******************************************************************/
int Set::getSize()
{
   return size;
}

/********************************************************************
* CLASS: Set
*    Default Destructor
********************************************************************/
Set::~Set()
{
   //clean up the list
   delete [] list;
   list = NULL;
   //since there are no other pointers and nothing else was created
   //using "new", we ignore the other member variables and allow
   //c++ to pick up the trash.
}

/********************************************************************
* CLASS: Set
*    Function for checking if the set already contains a  given value
********************************************************************/
bool Set::checkValue(int element) const
{
   //loop through the entire list and look for duplicates
   assert(size <= limit); //DEBUG
   for (int i = 0; i < size; i++)
   {
      if (element == list[i])
         return true;
   }
   return false;
}

/********************************************************************
* CLASS: Set
*    Add function for inserting a new number into the ordered list
********************************************************************/
bool Set::add(int num)
{
   //check to see if there is room in the inn...
   assert(size <= limit);
   //if the size is the same as the limit, re-allocate
   if (size == limit)
   {
      //re-allocate
      int* tmp = new int[limit];
      for (int i = 0; i < size; i++)
      {
         tmp[i] = list[i];
      }

      //delete list
      delete [] list;

      //re-allocate list
      limit += LIMIT_DEFAULT;
      list = new int[limit];

      //copy everything back to list
      for (int i = 0; i < size; i++)
      {
         list[i] = tmp[i];
      }

      //get rid of tmp
      delete [] tmp;
      tmp = NULL;
   }

   if (!checkValue(num)) //check for duplicates
   {
      assert(size <= limit);
      //ORDERING: find the index of first bigger number
      int index = 0;
      for (; (list[index] < num && index < size); index++)
      {
         //do nothing; this advances the index to the right spot
      }

      //if the size is reached, nothing in the set is bigger than the number
      if (index == size)
      {
         list[index] = num;
         size++;
         assert(size <= limit); //DEBUG
         return true;
      }

      //insert-scoot: make room for the new element in the right place.
      if (index < size)
      {
         //the number lands in the middle of the list, so we scoot things
         int scoot = list[index];
         assert(scoot > num); //DEBUG
         list[index] = num;
         index++;
         for (; index <= size; index++)
         {
            num = list[index];
            list[index] = scoot;
            scoot = num;
         }
         //now we need to update the size of the array by one
         size++;
         //we've succeeded, so we return true
         return true;
      }
   }
   //if this is reached, a duplicate was found, so we return false
   return false;
}

/********************************************************************
* CLASS: Set
*    OVERLOADED OPERATOR: =
*    This function implements the assignment operator for this class
********************************************************************/
const Set& Set::operator = (const Set &rhs)
{
   //check to see if the elements already are equal:
   if (*this == rhs)
   {
      return *this;
   }

   assert(rhs.size <= rhs.limit); //DEBUG
   //set the limit and size equal
   limit = rhs.limit;
   size = rhs.size;

   //re-allocate for the array
   delete [] list;
   list = new int[limit];

   //copy the array
   for (int i = 0; i < size; i++)
   {
      list[i] = rhs.list[i];
   }

   //we're finished
   return *this;
}

/********************************************************************
* CLASS: Set
*    OPERATOR OVERLOAD: -
*    This function implements the - operator as a set difference
********************************************************************/
const Set Set::operator - (const Set &rhs) const
{
   //create a temporary Set object
   Set tmp;

/*
* I don't have to worry about the size of the temporary Set as that
* is taken care of by the Set::add() function
*/

   for (int i = 0; i < size; i++)
   {
      if (!rhs.checkValue(list[i]))
         tmp.add(list[i]);
   }

   //though it is expensive, for readability and scope, i return by value
   return tmp;
}

/********************************************************************
* CLASS: Set
*    OPERATOR OVERLOAD: ||
*    Overload of || operator to act as set union operator
********************************************************************/
const Set  Set::operator || (const Set &rhs) const
{
   //create temporary Set object and copy one of the sides into it
   Set tmp(*this);

   for (int i = 0; i < rhs.size; i++)
   {
      tmp.add(rhs.list[i]);
   }
/*
*NOTICE: I do not check for duplicates here because add() already does that.
*/

   //return tmp by value to avoid scope bug
   return tmp;
}

/********************************************************************
* CLASS: Set
*    OPERATOR OVERLOAD: &&
*    Overloads the && operator as the intersection operator for sets
********************************************************************/
const Set Set::operator && (const Set &rhs) const
{
   //create temporary Set object
   Set tmp;

   //loop through one set and checkValue from the other
   for (int i = 0; i < size; i++)
   {
      //if the values exist in both sets, add it in
      if (rhs.checkValue(list[i]))
      {
         tmp.add(list[i]);
      }
   }
/*
*This is a very short function on purpose:  All necessary tools are
*already in place.  Why write the same code twice?
*/
   return tmp; //return by value to avoid scope bug
}

/********************************************************************
* CLASS: Set
*    OPERATOR OVERLOAD: ==
*    Overload the comparison operator (==) to allow the easy comparison
*    of two sets.
********************************************************************/
const bool Set::operator == (const Set &rhs) const
{
   //first, check the obvious
   if ((size != rhs.size) || (limit != rhs.limit))
      return false;

   //now we loop through both lists and check for equality
   for (int i = 0; i < size; i++)
   {
      if (list[i] != rhs.list[i])
         return false;
   }

   //if we make it this far, we're good to go
   return true;
}

/********************************************************************
* FRIEND: Set
*    OPERATOR OVERLOAD: <<
*    Overloads the insertion operator to make outputting a set easier
********************************************************************/
ostream& operator << (ostream &out, const Set &rhs)
{
   //loop through each of the items in the list and space them out
   int i = 0;
   for (; i < rhs.size; i++)
   {
      if (rhs.list[i] < 10)
      {
         out << "   ";
      }
      else
      {
         out << "  ";
      }
      out << rhs.list[i];

      //place new lines in the right places
      if (i % 10 == 9)
      {
         out << "\n"; //new line every 10 numbers
      }
   }
   //add the last new line if necessary
   if (i == rhs.size && ((i - 1) % 10 != 9))
   {
      out << "\n";
   }

   return out;
}

/********************************************************************
* processFile()
*    INPUT: char array and 2 Set objects by reference
*    This function opens the file.  If that fails, it informs the
*    calling function and returns.  If it succeeds, it reads in the
*    information from the file and stores it, in order, in each
*    of the two sets.
********************************************************************/
bool processFile(char file[], Set &set1, Set &set2)
{
   ifstream fin;
   fin.open(file);
   if (fin.fail())
      return false;

   //read in the first set
   int count = 0;
   int tmp;
   fin >> count;
   for (int i = 0; i < count; i++)
   {
      fin >> tmp;
      set1.add(tmp);
   }

   //read in the second set
   fin >> count;
   for (int i = 0; i < count; i++)
   {
      fin >> tmp;
      set2.add(tmp);
   }

   return true;
}

/********************************************************************
* executeSets()
*     INPUT: two Set objects
*     This function formats the output of the program, as well as
*     computes the desired actions as per the assignment
********************************************************************/
void executeSets(Set &set1, Set &set2)
{
   //NOT FINISHED
   cout << "Set A:\n" << set1 << endl;
   cout << "Set B:\n" << set2 << endl;
   cout << "Intersection of A and B:\n" << (set1 && set2) << endl;
   cout << "Union of A and B:\n" << (set1 || set2) << endl;
   cout << "Difference of A and B:\n" << (set1 - set2) << endl;
   cout << "Difference of B and A:\n" << (set2 - set1) << endl;
}

/********************************************************************
* main() CLASS TESTER
*    INPUT: argc, argv (from command line)
*    output: returns 0, governs program execution
********************************************************************/
int main(int argc, char* argv[])
{
   //declare 2 sets
   Set set1;
   Set set2;

   //check command line for file input
   if (argc < 1)
   {
      //create a container for the file
      char* file =  new char[256];
      //copy the file name
      strcpy(file, argv[1]);

      //we need to prompt for a file
      cout << "Enter a file name: ";
      cin >> file;
      if (!processFile(file, set1, set2))
      {
         cout << "File Error!\n";
         return -1;
      }
   }
   else //we have a file from the command line
   {
      //create a container for the file
      char* file =  new char[256];
      //copy the file name
      strcpy(file, argv[1]);

      if (!processFile(file, set1, set2))
      {
         cout << "File Error!\n";
         return -1;
      }
   }

   executeSets(set1, set2); //processes and executes the output

   //release memory by explicitly calling destructor:
   set1.~Set();
   set2.~Set();

   return 0;
}
