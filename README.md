# Elementor Repeater Accordions

An addon to add repeater-accordions (that's what I call them) to Elementor. 
There may be a better way to do this, but I could not find it. So, I created one for one of my projects.

## What do you mean by 'Repeated Accordions'?
Repeater accordions are just like the default accordions with the only difference being those get populated from a repeater field.

So, for example, assume that you have the following setup:
*  You have a custom post type *Tours* and it has a 0repeater-field with name *itinerary* , and this repeater field contains subfields like *itinerary_day*, *itinerary_schedule*, *itinerary_location* and so on.
*  You create a Post titled **India Tour** : You have attached 2 instances of itinerary to it. (See screenshot-1.png)
![](https://github.com/klainedigital/Elementor-Repeater-Accordions/blob/master/screenshot-1.png)
* You create a Post titled **France Tour**: You have attached 3 instances of itinerary to it.
* You have specified the *Accordion Title* to be picked from the subfield *itinerary_day* (See screenshot-2.png)
![](https://github.com/klainedigital/Elementor-Repeater-Accordions/blob/master/screenshot-2.png)
* You have specified the *Accordion Content* to be picked from the subfield *itinerary_schedule*

With this setup, when you use this addon, it will generate accordions dynamically.
So, there will be 2 accordion elments genrated for the post titled 'India Tour' and 3 accordion elements for the post titled 'France Tour'

And it will look something like screenshot-3.png

![](https://github.com/klainedigital/Elementor-Repeater-Accordions/blob/master/screenshot-3.png)

### Prerequisites

This addon requires [Elementor](https://wordpress.org/plugins/elementor/) and [JetEngine](https://jetengine.zemez.io/) to be installed and activated on the site.

### Installation
As you would install any other WordPress plugin.

## Authors

**Klaine Digital**  
* [Website](http://www.klainedigital.com)
* [GitHub](https://github.com/klainedigital)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to [Elementor](https://github.com/pojome/elementor) and [JetEngine](https://jetengine.zemez.io/) for their awesome products
* Thanks to [PurpleBooth](https://gist.github.com/PurpleBooth) for their [awesome readme template](https://gist.github.com/PurpleBooth/109311bb0361f32d87a2#file-readme-template-md)
