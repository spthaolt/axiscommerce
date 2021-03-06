/**
 * Axis
 *
 * This file is part of Axis.
 *
 * Axis is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Axis is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Axis.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * @copyright   Copyright 2008-2012 Axis
 * @license     GNU Public License V3.0
 */

Axis.grid.CheckColumn = function(config) {
    Ext.apply(this, config);
    if(!this.id) {
        this.id = Ext.id();
    }
    if (!this.fields) {
        this.fields = {
            enabled: 1,
            disabled: 0
        };
    }
    this.renderer = this.renderer.createDelegate(this);
};

Axis.grid.CheckColumn.prototype = {
    init: function(grid) {
        this.grid = grid;
        this.grid.on('render', function(){
            var view = this.grid.getView();
            view.mainBody.on('mousedown', this.onMouseDown, this);
        }, this);
    },

    onMouseDown: function(e, t) {
        if(t.className && t.className.indexOf('x-grid3-cc-'+this.id) != -1){
            e.stopEvent();
            var index = this.grid.getView().findRowIndex(t);
            var record = this.grid.store.getAt(index);
            record.set(
                this.dataIndex,
                record.data[this.dataIndex] == this.fields.disabled ? 
                    this.fields.enabled : this.fields.disabled
            );
        }
    },

    renderer: function(v, p, record) {
        p.css += ' x-grid3-check-col-td'; 
        return '<div class="x-grid3-check-col'+( v == this.fields.enabled ? '-on' : '')+' x-grid3-cc-'+this.id+'">&#160;</div>';
    }
};