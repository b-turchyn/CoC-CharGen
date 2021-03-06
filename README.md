# About

_CoC-CharGen_ is a character generator for [Call of Cthulhu](http://www.chaosium.com) (CoC) for both PCs (player characters) and NPCs (non-player characters). It supports 1890's, 1920's, and 1990's versions of the game. It's goal is to be:

* Universal - it's coded in good ol' PHP!
* Easy to use - just click a button!
* Expandable - a MySQL backend allows adding more names, places, colleges, and other information.
* Up-to-date - other generators haven't been updated in years!
* Complete - _CoC-CharGen_ will create everything for you, including your backstory, appearance, address, and more. 

[ohloh]: http://www.ohloh.net/p/coc-chargen/widgets/project_thin_badge.gif
[![Ohloh Project Page][ohloh]](https://www.ohloh.net/p/coc-chargen)

# Features

* General
    * Complete stats generation
    * Automatic calculation of IDEA, LUK, KNOW, hit points, and sanity points.
    * Option to disable mythos points allocation
    * Fully randomized country creation
    * Home town and name generated based on the home country to match region and ethnic background (% chance to be a non-native name based on era)
    * Education location (ie. what university) based on income level
    * Weighted randomization algorithm for occupation based on education
    * Appearance generates randomly based on size, strength, appearance.
    * Backstory randomly generates from lists of hundreds of different combinations of options. 
* Real content and data
    * Over 200 real, accredited universities and colleges, all historically accurate, with minimum required income levels. 
    * Over 100,000 first and last names, pulled from actual census data from the CoC eras.
    * Thousands of street names and suffixes, allowing in virtually millions of different street names.
    * Randomized chance of having a pre-existing mental disorder based on documented rates in CoC eras. 

# Installation

Unpack the `src/` directory into your `public_html/` (or equivalent) directory of your choice, and go to the `/install/` page. Follow the steps!

# Usage

* _TODO_

# Support

If you love Call of Cthulhu half as much as we do, buy some stuff from [http://www.chaosium.com/](http://www.chaosium.com) to support the game. Without them, we wouldn't need this tool!

_CoC-CharGen_ is supported by:

* [The I, Gamer Podcast](http://igamer.ca)
* [BrianTurchyn.net](http://brianturchyn.net)

Support them by listening to the podcast or tossing them a couple bucks for a beer. Beer has been known to [fuel programming productivity](http://xkcd.com/323/)!

# License

    Call of Cthulhu Character Generator
    Copyright (C) 2011-2014 Brian Turchyn
    All references to commercial items copyright their respective owners

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
     
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
