=== MTGPulse deckbox embedding tool ===
Contributors: perstilling
Tags: magic the gathering, deckbox, MtG, tcg, ccg, magic, cards, tooltips, mtgpulse, deck box, deck
Requires at least: 2.8.6
Tested up to: 3.3.1
Stable tag: 1.0.2

Facilitates embedding of MTGPulse.com deckboxes on your word press site 

== Description ==

The plugin adds any number of Magic: The Gathering deckboxes from mtgpulse.com to your wordpress site. The syntax for adding a deckbox is as follows:

`[deckbox did="number" size="small|normal" width="number" bgcolor="hexcolor"]`

* did: Deck id from mtgpulse.com
* width: Width of the deckbox in pixels.
* size: small or normal (use small if width < 800, normal if above). Difference is whether two or columns are used.
* bgcolor: the desired hex background color. For example FFFFFF for white.

For a custom decklist use the following syntax:

`[deckboxcustom name="test deck" size="small|normal" width="number" bgcolor="hexcolor"]
4 Glint Hawk Idol
4 Origin Spellbomb
4 Etched Champion
4 Memnite
4 Signal Pest
4 Vault Skirge
4 Glint Hawk
1 Oblivion Ring
4 Tempered Steel
3 Dispatch
4 Mox Opal
9 Plains
3 Gavony Township
4 Inkmoth Nexus
4 Razorverge Thicket
SB:
4 Shrine of Loyal Legions
2 Spellskite
4 Hero of Bladehold
1 Oblivion Ring
1 Celestial Purge
1 Dispatch
2 Mental Misstep
[/deckboxcustom]`

Same meaning as above, but name is the deck name that will be displayed.

For the three settings: size, width and color there is a settings page where you can apply the default value for these. This way you don't have to specify these every time you use the deckbox.

== Installation ==

1. Head over to the "Install Plugins" section of your Admin Panel, and use the "Upload" link to install the zip file.
2. Activate the plugin through the 'Plugins' menu.
3. Use the "MTGPulse" button in the editor, or manually write the tags.


== Frequently Asked Questions ==

== Screenshots ==

1. Example of how the deckbox will look when embedded on your site.

== Changelog ==

= 1.0.0 =

Created

= 1.0.1 =

Added bgcolor support

= 1.0.2 =

Added support for custom decks. Used through the new button that was added.